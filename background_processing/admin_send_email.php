<?php
        include('update_status.php');
        $Admin_accounts = $conn->prepare("SELECT email FROM `accounts` WHERE `id` = ?");
        $Admin_accounts->bind_param("s", $reqid);
        $Admin_accounts->execute();          
        $result = $Admin_accounts->get_result();
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        if(!$result)
        {
            die("query failed".mysqli_error());
        }
        else{
            while($row = $result->fetch_assoc()){
                $emails = $row['email'];
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
        $mail->Body = "You have recieved a new transport request from user";
        $mail->addAddress($emails);
        $mail->send();
            }
        

        
        }
        
        
        
        
        
                
    ?>

    