<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>

<?php
            $csrf_token = $_POST['csrf_token'];
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;
            
            // Check if the submitted token matches the one inside $_SESSION.
            if ($csrf_token === $_SESSION['CSRF token']) {
            
            include('database_connect.php');
            

            //get data from html form
            $reqid = $conn->real_escape_string($_POST["id"]);
            $action = $conn->real_escape_string($_POST["action"]);
            $comment = $conn->real_escape_string($_POST["comment"]);
            $userid = $conn->real_escape_string($_POST["user_id"]);
            if(empty($comment)){
                $comment = $reqid;
            }
            
            
            $sql_add_request = $conn->prepare("UPDATE `transport requests` SET `Status` = ?, `Comment` = ? WHERE `transport requests`.`RequestNumber` = ?");
            $sql_add_request->bind_param("ssi", $action, $comment, $reqid);
            
            if($sql_add_request->execute() === true){
                echo "Sucessfully added request.";
            }else{
                echo "ERROR: Failed to execute sql statement. " . $conn->error;
            }


        $Admin_accounts = $conn->prepare("SELECT `email` FROM `accounts` WHERE `id` = ?");
        $Admin_accounts->bind_param("i", $userid);
        $Admin_accounts->execute();          
        $result = $Admin_accounts->get_result();

        if(!$result)
        {
            die("query failed".mysqli_error());
        }
        else{
            while($row = $result->fetch_assoc()){
                $emails[] = $row['email'];
            }
        }


        
        

        require '../PHPMailer/src/Exception.php';
        require '../PHPMailer/src/PHPMailer.php';
        require '../PHPMailer/src/SMTP.php';
        
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'joseph2003dzanja@gmail.com';
        $mail->Password = 'hmskzxolswnhynvo';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('joseph2003dzanja@gmail.com');
        
        $mail->isHTML(true);
        $mail->Subject = "Transport Request";
        $mail->Body = "You have have recieved a response for your transport request";
        
        foreach ($emails as $x) {
            $mail->addAddress($x);
            $mail->send();
          }



            header("location: ../admin_view_pending.php");

             }
            else {
                echo 'Token invalid. Operation not allowed.<br>';
            }

?>


    

