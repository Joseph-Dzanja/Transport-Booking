<?php
session_start();

include('database_connect.php');
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['email']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill the email field!');
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$token = bin2hex(random_bytes(16));
if ($stmt = $conn->prepare('SELECT email FROM accounts WHERE email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($email);
        $stmt->fetch();

        $sql_add_request = $conn->prepare("UPDATE `accounts` SET `passreset` = ? WHERE `email` = ?");
        $sql_add_request->bind_param("ss", $token,$email);
        $sql_add_request->execute();
       

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


        $mail->Body = "<!DOCTYPE html>
        
        <head>
            <title>Document</title>
        </head>
        <body>
            <p>click here to change your password <a href='192.168.13.246/transport-booking/reset_password.php?h=$token'>click here</a></p>
        </body>
        </html>";
        
        
        
        $mail->addAddress($email);
        $mail->send();
          
        
    }else{
        echo "Email does not exist";
    }
}
?>