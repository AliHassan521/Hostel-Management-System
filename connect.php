<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roll = $_POST["roll"];
    $name = $_POST["name"];
    $cnic = $_POST["CNIC"];
    $password = $_POST["password"]; 
    $birthday = $_POST["birthday"];
    $gender = $_POST["Gender"];
    $email = $_POST["Email"];
    $phone = $_POST["Phone"];
    $aggregate = $_POST["Aggregate"];
    $department = $_POST["Zip"];
    $address = $_POST["Address"];
    $city = $_POST["City"];
    $emergency_contact = $_POST["Line"];
    $converted_date = date('Y-m-d', strtotime($birthday));

    $sql = "INSERT INTO application (roll, name, cnic, password, birthday, gender, email, phone, aggregate, department, address, city, emergency_contact)
        VALUES ('$roll', '$name', '$cnic', '$password', '$converted_date', '$gender', '$email', '$phone', '$aggregate', '$department', '$address', '$city', '$emergency_contact')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>
        if(confirm("Data inserted successfully. Click OK to continue.")){
            window.location.href = "join.html";
        } else {
            window.location.href = "join.html"; 
        }
      </script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();

