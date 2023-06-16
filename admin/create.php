<?php
$host = 'localhost';
$dbname = 'test';
$username = 'root';
$password = '';
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

$roomNumber = $_POST['room_number'];
$capacity = $_POST['capacity'];
$available = true;
$stmt = $pdo->prepare("INSERT INTO rooms (room_number, capacity, available) VALUES (:room_number, :capacity, :available)");
$stmt->bindParam(':room_number', $roomNumber);
$stmt->bindParam(':capacity', $capacity);
$stmt->bindParam(':available', $available);
$stmt->execute();
echo "<script>alert('Room $roomNumber has been added successfully.')</script>";
header("Location: home.html");
exit();
