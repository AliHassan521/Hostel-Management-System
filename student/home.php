<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
  <style>
    /* Navbar styles */
    nav {
      background-color: #333;
      overflow: hidden;
    }

    nav a {
      float: left;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }

    nav a:hover {
      background-color: #ddd;
      color: black;
    }

    .heading1 {
      font-size: 30px;
      font-weight: bold;
      color: #333;
      text-align: center;
      text-decoration: none;
      padding: 14px 16px;
      margin-bottom: 16px;
      border-radius: 4px;
      -webkit-border-radius: 4px;
      -moz-border-radius: 4px;
      -o-border-radius: 4px;
      -ms-border-radius: 4px;
      background-color: #f0f0f0;
    }

    .heading2 {
      font-size: 20px;
      font-weight: bold;
      color: #333;
      text-align: center;
      text-decoration: none;
      padding: 14px 16px;
      margin: auto;
      border-radius: 4px;
    }


    /*--copy-right--*/

    .footer-copy-right {
      padding: 20px 20px;
      background: rgba(0, 0, 0, 0.72);
      margin-top: 10px;

    }

    .footer-copy-right p {
      padding: 1em 0;
      text-align: center;
      color: #fff;
      margin: 0;
      letter-spacing: 2px;
      font-size: 14px;
    }
  </style>
</head>

<body>
  <h1 class="heading1"><a href="home.php">Student Section</a></h1>
  <nav>
    <a href="profile.php">Profile</a>
    <a href="fee.php">Fee</a>
    <a href="complain.html">Complain Section</a>
    <a href="yourcomplain.php">Your Complain</a>
    <a href="logout.php">Log out</a>
  </nav>


  <div class="container">
    <h2 class="heading2">Home Page</h2>

    <?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'test';

    $conn = new mysqli($hostname, $username, $password, $database);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    session_start();
    if (!isset($_SESSION['roll'])) {
      echo '<div class="alert alert-danger">You are not logged in.</div>';
      exit;
    }

    $loggedInRoll = $_SESSION['roll'];

    $query = "SELECT roll, password FROM login_info WHERE roll = '$loggedInRoll'";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $roll = $row['roll'];
      $password = $row['password'];

      $nameQuery = "SELECT name FROM approved WHERE roll = '$roll'";
      $nameResult = $conn->query($nameQuery);
      if ($nameResult->num_rows > 0) {
        $nameRow = $nameResult->fetch_assoc();
        $name = $nameRow['name'];
        echo '<div class="alert alert-info">';
        echo "Welcome, $name!<br>";
        echo '</div>';
      }

      echo '<div class="alert alert-info">';
      echo "<strong>Login ID:</strong> $roll<br>";
      echo "<strong>Password:</strong> $password<br>";
      echo '</div>';

      echo '
            <form method="post">
                <div class="form-group">
                    <label for="new_password">New Password:</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <button type="submit" name="change_password" class="btn btn-primary">Change Password</button>
            </form>
            ';
    } else {
      echo '<div class="alert alert-warning">No login information found for your roll.</div>';
    }

    if (isset($_POST['change_password'])) {
      $newPassword = $_POST['new_password'];
      $updateQuery = "UPDATE login_info SET password = '$newPassword' WHERE roll = '$loggedInRoll'";
      if ($conn->query($updateQuery) === true) {
        echo '<div class="alert alert-success">Password updated successfully.</div>';
      } else {
        echo '<div class="alert alert-danger">Error updating password: ' . $conn->error . '</div>';
      }
    }

    $conn->close();
    ?>


  </div>

  <!-- Include Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>








<div class="footer-copy-right">
  <div class="container">
    <div class="allah-copy">
      <p>Project by : Azhar hayat || Ali hassan || Zargham elahi</p>
    </div>
  </div>
</div>
</body>

</html>