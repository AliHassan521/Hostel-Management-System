<?php

if(isset($_POST['complaint_id'])) {
    $complaintId = $_POST['complaint_id'];
    $dbHost = 'localhost';
    $dbName = 'test';
    $dbUser = 'root';
    $dbPass = '';
    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $query = "DELETE FROM complaints WHERE id = :complaint_id";
    $statement = $conn->prepare($query);
    $statement->bindParam(':complaint_id', $complaintId);
    $statement->execute();
    if ($statement->rowCount() > 0) {
        
        echo "<script>alert('Complaint deleted successfully.');</script>";
    } else {
        
        echo "<script>alert('Failed to delete the complaint.');</script>";
    }
} else {
    echo "<script>alert('Invalid request.');</script>";
}
header("Location: complains.php");
exit();

