<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
$token = bin2hex(random_bytes(16));
$_SESSION['CSRF token'] = $token;
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
<!-- <li><a href="#"><i class="fas fa-calendar-week"></i>Events</a></li>
<li><a href="#"><i class="far fa-question-circle"></i>About</a></li>
<li><a href="#"><i class="fas fa-sliders-h"></i>Services</a></li>
<li><a href="#"><i class="far fa-envelope"></i>Contact</a></li> -->
</ul>
</div>
<section>
    <?php
    
        if(isset($_GET['id']))
        {
            $id = $_GET['id']; 
        }
        
              $list_requests = $conn->prepare("SELECT * FROM `transport requests` WHERE `RequestNumber` = ?");
              $list_requests->bind_param("i", $id);  
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

    <h2 class="admin_view_request_header">User : <?php echo $row['Username']; ?></h2>
    
    <div class="container">
        <div class="form-container form-container-admin">
            <div class="admin-view-request-container-flex">
                <div class="row-item">
                  <span class= "admin_view_label">Request Number :</span> <?php echo $row['RequestNumber']; ?>
                </div>
                <div class="row-item">
                  <span class="admin_view_label">Date and Time of departure:</span> <?php echo $row['DateAndTimeRequested']; ?>
                </div>
                <div class="row-item">
                  <span class="admin_view_label">Return Time:</span> <?php echo $row['TimeBack']; ?>
                </div>
                <div class="row-item">
                  <span class="admin_view_label">Vehicle Requested:</span> <?php echo $row['TypeOfVehicle']; ?>
                </div>
                <div class="row-item">
                  <span class="admin_view_label">Number of passengers:</span> <?php echo $row['NumberOfPassengers']; ?>
                </div>
                <div class="row-item">
                  <span class="admin_view_label">Pickup Location:</span> <?php echo $row['PickupLocation']; ?>
                </div>
                <div class="row-item">
                  <span class="admin_view_label">Destination:</span> <?php echo $row['Destination']; ?>
                </div>
                <div class="row-item">
                  <span class="admin_view_label">Purpose of Journey:</span> <?php echo $row['PurposeOfJourney']; ?>
                </div>
                <div class="row-item">
                  <span class="admin_view_label">Status:</span> <?php echo $row['Status']; ?>
                </div>
            </div>
            <form action="background_processing/update_status.php" method="POST">
              <div>
                  <label class="input-labels" for="action">Action:</label><br>
                          <select class="admin-action" name="action" id="action">
                              <option value="Approved">Accept</option>
                              <option value="Declined">Decline</option>
                          </select>
              </div>
              <div>
                  <label class="input-labels" for="comment">Comment</label>
                  <textarea id="comment" class="admin-comment" name="comment" placeholder="Comment" maxlength="200"></textarea>
              </div>
              <div>
                  <input type="hidden" name="id" value=<?php echo $row['RequestNumber'] ?>>
              </div>
              <div>
                  <input type="hidden" name="user_id" value=<?php echo $row['user_id'] ?>>
              </div>
              <?php echo '<input type="hidden" name="csrf_token" value="' . htmlentities($token, ENT_QUOTES | ENT_HTML5, 'UTF-8') . '"> '  ?>
              <div>
              <input class="submit-request-response" type="submit" value="Submit">
              </div>
            </form>
        </div>
    </div>
</section>
  </body>
</html>
