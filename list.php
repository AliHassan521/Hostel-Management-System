<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT roll, name, cnic, aggregate, city FROM approved";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Approved Data</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Approved Data</h2>
    <table>
        <tr>
            <th>Ecat Roll Number</th>
            <th>Name</th>
            <th>CNIC</th>
            <th>Aggregate</th>
            <th>City</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["roll"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["cnic"] . "</td>";
                echo "<td>" . $row["aggregate"] . "</td>";
                echo "<td>" . $row["city"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No data found for approved students</td></tr>";
        }
        ?>
    </table>

    <?php $conn->close(); ?>
</body>

</html>