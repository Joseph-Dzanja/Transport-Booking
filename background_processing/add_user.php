

    <?php
            
                include('database_connect.php');
                $sql_add_request = $conn->prepare("INSERT INTO `accounts` (username,password,email) VALUES (?,?,?)");
                $sql_add_request->bind_param("sss", $username, $password,$email);
                
                            
                //get data from html form
                $username = $_POST['username'];
                $passcode = $_POST['password'];
                $password = password_hash($passcode, PASSWORD_BCRYPT);
                $email = $_POST['email'];
                

                    if($sql_add_request->execute() === true)
                    {
                        echo "Account Pending Approval.";
                    }
                    else{
                        echo "ERROR: Username or Email already in use. " . $conn->error;
                        }
            
                header("refresh:4; url = ../index.html");


     ?>

    

