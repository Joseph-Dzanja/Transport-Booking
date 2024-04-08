<?php
        $Admin = 'Admin';
        $Admin_accounts = $conn->prepare("SELECT email FROM `accounts` WHERE `AccountType` = ?");
        $Admin_accounts->bind_param("s", $Admin);
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


        $sender = $_SESSION['name'];
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

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
        $mail->Body = "You have recieved a new transport request from user : $sender";
        
        foreach ($emails as $x) {
            $mail->addAddress($x);
            $mail->send();
          }

        
                
    ?>

    