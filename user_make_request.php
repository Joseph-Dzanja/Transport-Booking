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

<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Sider Menu Bar CSS</title> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="styles/styles.css">
    <script src="javascript/script.js" defer></script>
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
  <li><a href="user_make_request.php"><i class="fas fa-qrcode"></i>Make Requests</a></li>
  <li><a href="user_view_pending.php"><i class="fas fa-stream"></i>Pending</a></li>
  <li><a href="user_completed_requests.php"><i class="fas fa-link"></i>Requests</a></li>
  <li><a href="logout.php"><i class="fas fa-calendar-week"></i>Log Out</a></li>
<!--
<li><a href="#"><i class="far fa-question-circle"></i>About</a></li>
<li><a href="#"><i class="fas fa-sliders-h"></i>Services</a></li>
<li><a href="#"><i class="far fa-envelope"></i>Contact</a></li> -->
</ul>
</div>
<section>
  <div class="container">
        <div class="form-container">
            <form action="./background_processing/add_requests.php" method="POST">
                <div class="user-form-flex">
                    <div>
                        <label class="input-labels" for="date-timeout" class="stack">Date and Time</label><br>
                        <input type="datetime-local" class="input-date-timeout" id="date-timeout" name ="date-timeout">
                    </div>
                    <div>
                        <label class="input-labels" for="time-back" class="stack">Time</label><br>
                        <input type="time" class="input-time-back" id="time-back" name="time-back" required>
                    </div>
                </div>
                
                <div>
                    <label class="input-labels" for="vehicle-names">Choose the type of vehicle:</label><br>
                            <select class="input-vehicle-names" id="vehicle-names" name="vehicle-names">
                                <option value="Saloon(5)">Saloon(5)</option>
                                <option value="Pickup(2)">Pickup(2)</option>
                                <option value="Station Wagon(2)">Station Wagon(2)</option>
                                <option value="2 Ton Lorry(1)">2 Ton Lorry(1)</option>
                                <option value="5 Ton Lorry(1)">5 Ton Lorry(1)</option>
                                <option value="Ton Lorry(10)">Ton Lorry(10)</option>
                                <option value="Seater Minibus(16)">Seater Minibus(16)</option>
                                <option value="Seater Minibus(30)">Seater Minibus(30)</option>
                                <option value="Seater Bus(65)">Seater Bus(65)</option>
                            </select>
                </div>
                <div>
                    <label class="input-labels" for="num-passengers">Number of passengers</label>
                    <input type="number" class="input-num-passengers" id="num-passengers" name="num-passengers" min = "1" max= "80" required>
                </div>
                <div>
                    <label class="input-labels" for="location">Pickup location</label>
                    <input type="text" class="input-location" id="location" name ="location" required>
                </div>
                <div>
                    <label class="input-labels" for="destination">Destination</label>
                    <input type="text" class="input-destination" id="destination" name="destination">
                </div>
                <div>
                    <label class="input-labels" for="purpose">Purpose</label>
                    <textarea class="input-purpose" id="purpose" name="purpose" placeholder="Purpose of Journey" maxlength="200" required></textarea>
                </div>
                <?php echo '<input type="hidden" name="csrf_token" value="' . htmlentities($token, ENT_QUOTES | ENT_HTML5, 'UTF-8') . '"> '  ?>
                <div>
                    <input class="submit-request" type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
</section>
</body>
</html>
