<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$username = $_POST['username'];
$password = $_POST['password'];
$roll = $_POST['roll'];
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO logininfo (username, password, student_roll) VALUES ( '$username', '$password', '$roll')";

if ($conn->query($sql) === true) {
    
    echo "Login account created successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
