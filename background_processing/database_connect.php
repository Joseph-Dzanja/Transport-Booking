<?php
        //Attempt to connect to the database
        $conn = new mysqli("localhost", "root", "", "transport-booking");

        //check connection
        if($conn === false){
            die("ERROR: Could not connect. " .$conn->connect_error);
        }

?>