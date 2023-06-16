<!DOCTYPE html>
<html>

<head>
  <title>Display Fee</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    .container {
      max-width: 500px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .btn-primary {
      margin-right: 10px;
    }

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
    <h2 class="heading2">Display Fee</h2>

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

    $query = "SELECT fee, status FROM fee WHERE roll = '$loggedInRoll'";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $fee = $row['fee'];
      $status = $row['status'];
      echo '<div class="alert alert-info">';
      echo "<strong>Roll:</strong> $loggedInRoll<br>";
      echo "<strong>Fee:</strong> $fee<br>";
      echo "<strong>Status:</strong> $status<br>";
      echo '</div>';
    } else {
      echo '<div class="alert alert-warning">No fee details found for your roll.</div>';
    }
    $conn->close();
    ?>

    <a href="logout.php" class="btn btn-primary">Logout</a>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <div class="footer-copy-right">
    <div class="container">
      <div class="allah-copy">
        <p>Project by : Azhar hayat || Ali hassan || Zargham elahi</p>
      </div>
    </div>
  </div>
</body>

</html>