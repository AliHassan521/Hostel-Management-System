<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roll = $_POST["roll"];

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM application WHERE roll = '$roll'";

    if ($conn->query($sql) === TRUE) {
        echo "Data rejected and deleted successfully.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
