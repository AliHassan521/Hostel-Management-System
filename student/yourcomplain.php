<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['roll'])) {
    header("Location: login.php");
    exit;
}

$loggedInRollNumber = $_SESSION['roll'];
$sql = "SELECT * FROM complaints WHERE roll = '$loggedInRollNumber'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Complaints</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .complaint {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
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
        <h2 class="heading2">View Complaints</h2>
        <?php if ($result->num_rows > 0) : ?>
            <?php while ($complaint = $result->fetch_assoc()) : ?>
                <div class="complaint">
                    <h4>Complaint ID: <?php echo $complaint['id']; ?></h4>
                    <p><strong>Registration Number:</strong> <?php echo $complaint['registration_number']; ?></p>
                    <p><strong>Complaint:</strong> <?php echo $complaint['complain']; ?></p>
                    <?php if ($complaint['reply']) : ?>
                        <p><strong>Reply:</strong> <?php echo $complaint['reply']; ?></p>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <p>No complaints found.</p>
        <?php endif; ?>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <div class="footer-copy-right">
        <div class="container">
            <div class="allah-copy">
                <p>Project by : Azhar hayat || Ali hassan || Zargham elahi</p>
            </div>
        </div>
    </div>
</body>

</html>

<?php
$conn->close();
?>