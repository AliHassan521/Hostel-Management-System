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
    $complaint_id = $_POST["complaint_id"];
    $reply = $_POST["reply"];

    $sql = "UPDATE complaints SET reply = '$reply' WHERE id = $complaint_id";

    if ($conn->query($sql) === TRUE) {
        
        header("Location: home.html");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
