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
            
            // Check if the submitted token matches the one inside $_SESSION.
            if ($csrf_token === $_SESSION['CSRF token']) {
                
                
                include('database_connect.php');
                include('send_email.php');
                $sql_add_request = $conn->prepare("INSERT INTO `transport requests` (Username,DateAndTimeRequested, TimeBack, TypeOfVehicle, NumberOfPassengers, PickupLocation, Destination, PurposeOfJourney, user_id) VALUES (?,?,?,?,?,?,?,?,?)");
                $sql_add_request->bind_param("sssssssss", $user, $dateTime, $timeBack, $vehicleNames,$numPassengers,$location,$destination,$purpose,$UserID);
                
                            
                //get data from html form
                $UserID = $_SESSION['id'];
                $user = $_SESSION['name'];
                $dateTimez = $conn->real_escape_string($_POST["date-timeout"]);
                    $dt = new DateTime($dateTimez);
                    $dateTime = $dt->format('Y-m-d H:i:s');
                $timeBack = $conn->real_escape_string($_POST["time-back"]);
                $vehicleNames = $conn->real_escape_string($_POST["vehicle-names"]);
                $numPassengers = $conn->real_escape_string($_POST["num-passengers"]);
                $location = $conn->real_escape_string($_POST["location"]);
                $destination = $conn->real_escape_string($_POST["destination"]);
                $purpose = $conn->real_escape_string($_POST["purpose"]);

                    if($sql_add_request->execute() === true)
                    {
                        echo "Sucessfully added request."; 
                    }
                    else{
                        echo "ERROR: Failed to execute sql statement. " . $conn->error;
                        }
            
            

            header("refresh:1; url = ../user_make_request.php");

            }
            else {
                echo 'Token invalid. Operation not allowed.<br>';
            }

            
     ?>

    

