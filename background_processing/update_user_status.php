

    <?php
                include('database_connect.php');
                $status = $_POST['active'];
                $reqid = $_POST["id"];

                if($status === 'Decline'){
                    $sql_add_request = $conn->prepare("DELETE FROM `accounts` WHERE `id` = ?");
                    $sql_add_request->bind_param("i", $reqid);

                    if($sql_add_request->execute() === true)
                    {
                        echo "Sucessfully deleted request.";
                    }
                    else{
                        echo "ERROR: Failed to execute sql statement. " . $conn->error;
                        }
                }
                else{
                    $status = "active";
                    $sql_add_request = $conn->prepare("UPDATE `accounts` SET `ActivationStatus` = ? WHERE `id` = ?");
                    $sql_add_request->bind_param("si", $status, $reqid);

                    if($sql_add_request->execute() === true)
                    {
                        echo "Sucessfully created account.";
                    }
                    else{
                        echo "ERROR: Failed to execute sql statement. " . $conn->error;
                        }
                }
                
                
                            
                //get data from html form
                
                header("refresh:1; url = ../admin_view_users.php");


     ?>

    

