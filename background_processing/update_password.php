<?php 
include('database_connect.php');
$password = $_POST['password'];
$confirmpass = $_POST['confirm_password'];
$token = $_POST['token'];
if($password === $confirmpass){
    $password = password_hash($password, PASSWORD_BCRYPT);
    $sql_add_request = $conn->prepare("UPDATE `accounts` SET `password` = ? WHERE `accounts`.`passreset` = ?");
    $sql_add_request->bind_param("ss", $password,$token);
    $sql_add_request->execute();
    echo "password changed successfully";
    $token = NULL;
    $sql_add_request = $conn->prepare("UPDATE `accounts` SET `passreset` = ? WHERE `accounts`.`password` = ?");
    $sql_add_request->bind_param("ss", $token,$password);
    $sql_add_request->execute();
}
else{
    echo "passwords dont match";
}

?>