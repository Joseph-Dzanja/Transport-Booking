<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>

<!DOCTYPE html>
<?php include('background_processing/database_connect.php'); ?>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Sider Menu Bar CSS</title> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="styles/styles.css">
    <script src="./javascript/script.js" defer></script>
  </head>
  <body>
    <input type="checkbox" id="check">
    <label for="check">
      <i class="fas fa-bars" id="btn"></i>
      <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
    <header>Transport App</header>
  <ul>
<li><a href="admin_view_pending.php"><i class="fas fa-qrcode"></i>Pending</a></li>
<li><a href="admin_completed_requests.php"><i class="fas fa-link"></i>Completed</a></li>
<li><a href="admin_view_users.php"><i class="fas fa-stream"></i>Users</a></li>
<li><a href="logout.php"><i class="fas fa-calendar-week"></i>Log Out</a></li>
<!-- <li><a href="#"><i class="fas fa-stream"></i>Overview</a></li>
<li><a href="#"><i class="fas fa-calendar-week"></i>Events</a></li>
<li><a href="#"><i class="far fa-question-circle"></i>About</a></li>
<li><a href="#"><i class="fas fa-sliders-h"></i>Services</a></li>
<li><a href="#"><i class="far fa-envelope"></i>Contact</a></li> -->
</ul>
</div>
<section class="sect">
  <h2>Request Table</h2>
  <div class="table-wrapper">
      <table class="fl-table">
          <thead>
          <tr>
              <th>User</th>
              <th> Request ID</th>
              <th>Date and Time for Request</th>
              <th>Time back</th>
              <th>Vehicle name</th>
              <th>Number of passengers</th>
              <th>Pickup Location</th>
              <th>Destination</th>
              <th>Purpose</th>
              <th>Status</th>
          </tr>
          </thead>
          <tbody>
            <?php 
                $accepted = 'Approved';
                $declined = 'Declined';
                

                $list_requests = $conn->prepare("SELECT * FROM `transport requests` WHERE `Status` = ? OR `Status` = ?");
                $list_requests->bind_param("ss", $accepted, $declined);
                $list_requests->execute();
                $result = $list_requests->get_result();
                // $data = $result->fetch_assoc();
                // $result = mysqli_query($conn, $list_requests);
                if(!$result)
                {
                    die("query failed".mysqli_error());
                }
                else{
                    while($row = $result->fetch_assoc()){
                        ?>
                            <tr>
                                <td><?php echo $row['Username']; ?></td>
                                <td><?php echo $row['RequestNumber']; ?></td>
                                <td class="table_scroll"><?php echo $row['DateAndTimeRequested']; ?></td>
                                <td><?php echo $row['TimeBack']; ?></td>
                                <td><?php echo $row['TypeOfVehicle']; ?></td>
                                <td><?php echo $row['NumberOfPassengers']; ?></td>
                                <td class="table_scroll"><?php echo $row['PickupLocation']; ?></td>
                                <td class="table_scroll"><?php echo $row['Destination']; ?></td>
                                <td class="table_scroll"><?php echo $row['PurposeOfJourney']; ?></td>
                                <td><?php echo $row['Status']; ?></td>
                            </tr>
                        <?php
                    }
                }
                    

            ?>
          <tbody>
      </table>
  </div>
</section>
  </body>
</html>
