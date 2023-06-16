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

    // Get the data from the original table
    $sql_select = "SELECT * FROM application WHERE roll = '$roll'";
    $result = $conn->query($sql_select);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $sql_insert_approved = "INSERT INTO approved (roll, name, cnic, password, birthday, gender, email, phone, aggregate, department, address, city, emergency_contact) VALUES ('$row[roll]', '$row[name]', '$row[cnic]', '$row[password]', '$row[birthday]', '$row[gender]', '$row[email]', '$row[phone]', '$row[aggregate]', '$row[department]', '$row[address]', '$row[city]', '$row[emergency_contact]')";

        if ($conn->query($sql_insert_approved) === TRUE) {
            $sql_insert_fee = "INSERT INTO fee (roll, fee, status) VALUES ('$row[roll]', 2000, 'unpaid')";
            if ($conn->query($sql_insert_fee) === TRUE) {
                $sql_delete = "DELETE FROM application WHERE roll = '$roll'";
                if ($conn->query($sql_delete) === TRUE) {
                    echo "Data approved and moved to 'approved' table and 'fee' table successfully.";
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            } else {
                echo "Error inserting record into 'fee' table: " . $conn->error;
            }
        } else {
            echo "Error inserting record into 'approved' table: " . $conn->error;
        }
    } else {
        echo "No record found for the given roll number.";
    }

    $conn->close();
}
