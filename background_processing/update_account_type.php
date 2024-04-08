<?php
    include('database_connect.php');
    $accountType = $_POST['myfield'];
    $reqid = $_POST["id"];
    $sql_add_request = $conn->prepare("UPDATE `accounts` SET `AccountType` = ? WHERE `id` = ?");
    $sql_add_request->bind_param("si", $accountType, $reqid);

    if($sql_add_request->execute() === true)
    {
        echo "Successfully updated account type.";
    }
    else{
        echo "ERROR: Failed to execute sql statement. " . $conn->error;
        }


    header("refresh:0; url = ../admin_view_users.php");

?>

