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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $loggedInRollNumber = $_SESSION['roll'];

    $registrationNumber = $_POST['registration_number'];
    $complain = $_POST['complain'];
    $sql = "INSERT INTO complaints (roll, registration_number, complain) VALUES ('$loggedInRollNumber', '$registrationNumber', '$complain')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Complaint submitted successfully!');</script>";
        
        echo "<script>window.location.href = 'home.php';</script>";
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
