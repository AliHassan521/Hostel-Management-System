<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Student Profile</title>
  <!-- Add the Bootstrap CSS file link -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
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
  <h2 class="heading2">Student Profile</h2>
  <?php
  session_start();
  if ($_SESSION["user_type"] === "student") {

    $roll = $_SESSION["roll"];

    $servername = "localhost";
    $username = "root";
    $dbPassword = ""; 
    $dbname = "test";

  
    $conn = new mysqli($servername, $username, $dbPassword, $dbname); 

    
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("SELECT * FROM approved WHERE roll=?");
    $stmt->bind_param("s", $roll);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      echo '<table class="table table-bordered">';
      echo '<tr><th>Roll</th><td>' . $row["roll"] . '</td></tr>';
      echo '<tr><th>Name</th><td>' . $row["name"] . '</td></tr>';
      echo '<tr><th>Password</th><td>' . $row["password"] . '</td></tr>';
      echo '<tr><th>CNIC</th><td>' . $row["cnic"] . '</td></tr>';
      echo '<tr><th>Rooms</th><td>' . $row["room_number"] . '</td></tr>';
      echo '<tr><th>Birthday</th><td>' . $row["birthday"] . '</td></tr>';
      echo '<tr><th>Gender</th><td>' . $row["gender"] . '</td></tr>';
      echo '<tr><th>Email</th><td>' . $row["email"] . '</td></tr>';
      echo '<tr><th>Phone Number</th><td>' . $row["phone"] . '</td></tr>';
      echo '<tr><th>Department</th><td>' . $row["department"] . '</td></tr>';
      echo '<tr><th>Address</th><td>' . $row["address"] . '</td></tr>';
      echo '<tr><th>City</th><td>' . $row["city"] . '</td></tr>';
      echo '<tr><th>Emergency Contact</th><td>' . $row["emergency_contact"] . '</td></tr>';
      echo '</table>';
      echo '</div>';
    } else {
      echo "Student data not found.";
    }

    $stmt->close();
    $conn->close();
  } else {
    header("Location: login.html");
    exit();
  }
  ?>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <div class="footer-copy-right">
    <div class="container">
      <div class="allah-copy">
        <p>Project by : Azhar hayat || Ali hassan || Zargham elahi</p>
      </div>
    </div>
  </div>
</body>

</html>