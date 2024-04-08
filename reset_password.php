<?php
        include('background_processing/database_connect.php');
        if(isset($_GET['h']))
        {
            $token = $_GET['h']; 
        }
        
              $list_requests = $conn->prepare("SELECT passreset FROM `accounts` WHERE `passreset` = ?");
              $list_requests->bind_param("s", $token);  
              $list_requests->execute();
              $result = $list_requests->get_result();

            if(!$result)
                    {
                        die("query failed".mysqli_error($conn));
                    }
                    else{
                      $row = $result->fetch_assoc();
 
        }
        
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="form_container">
    <form action="background_processing/update_password.php" method="POST">
        <label for="password">Enter New Password</label>
        <input type="password" name="password" id="password">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password">
        <input type="hidden" name="token" value="<?php echo $token ?>">
        <input type="submit" value="reset">
    </form>
</div>
</body>
</html>