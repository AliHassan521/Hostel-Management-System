<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$roll = $_POST["roll"];
$userPassword = $_POST["password"]; 

$servername = "localhost";
$username = "root";
$dbPassword = ""; 
$dbname = "test";
$conn = new mysqli($servername, $username, $dbPassword, $dbname); // Use the corrected variable name

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM login_info WHERE roll=? AND password=?");
$stmt->bind_param("ss", $roll, $userPassword); 
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
$row = $result->fetch_assoc();


if ($roll == "admin" && $userPassword == "admin") {
$_SESSION["user_type"] = "admin";

header("Location: admin/home.html");
exit();
} else {
$_SESSION["user_type"] = "student";

   $_SESSION["roll_number"] = $row["roll"];
            $_SESSION["roll"] = $roll;


header("Location: student/home.php");
exit();
}
} else {
echo "Invalid roll or password.";
}

$stmt->close();
$conn->close();
}