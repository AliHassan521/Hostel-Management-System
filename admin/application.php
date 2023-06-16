<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM application";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Form Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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

        .status-buttons button {
            margin-right: 5px;
        }

        .bt {
            margin-top: 10px;
        }

        nav {
            background-color: #333;
            overflow: hidden;
        }

        nav a {
            float: left;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav a:hover {
            background-color: #ddd;
            color: black;
        }

        .heading1 {
            font-size: 30px;
            font-weight: bold;
            color: #333;
            text-align: center;
            text-decoration: none;
            padding: 14px 16px;
            margin-bottom: 16px;
            border-radius: 4px;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            -o-border-radius: 4px;
            -ms-border-radius: 4px;
            background-color: #f0f0f0;
        }

        .footer-copy-right {
            padding: 20px 20px;
            background: rgba(0, 0, 0, 0.72);
            margin-top: 10px;
        }

        .footer-copy-right p {
            padding: 1em 0;
            text-align: center;
            color: #fff;
            margin: 0;
            letter-spacing: 2px;
            font-size: 14px;
        }

        .heading2 {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            text-align: center;
            text-decoration: none;
            padding: 14px 16px;
            margin: auto;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <h1 class="heading1"><a href="home.html">Admin Panel</a></h1>
    <nav>
        <a href="application.php">Applications</a>
        <a href="createroom.html">Create Room</a>
        <a href="displayroom.php">Room List</a>
        <a href="aprovedstudent.php">Register Student</a>
        <a href="showdata.php">Show Data</a>
        <a href="payment.php">Payment Management</a>
        <a href="complains.php">Complains</a>
        <a href="logout.php">Log out</a>
    </nav>
    <h2 class="heading2">Form Data</h2>
    <table>
        <tr>
            <th>Ecat Roll Number</th>
            <th>Name</th>
            <th>CNIC</th>
            <th>password</th>
            <th>Birth Date</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Aggregate</th>
            <th>Department</th>
            <th>Address</th>
            <th>City</th>
            <th>Emergency Contact</th>

            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["roll"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["cnic"] . "</td>";
                echo "<td>" . $row["password"] . "</td>";
                echo "<td>" . $row["birthday"] . "</td>";
                echo "<td>" . $row["gender"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["phone"] . "</td>";
                echo "<td>" . $row["aggregate"] . "</td>";
                echo "<td>" . $row["department"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td>" . $row["city"] . "</td>";
                echo "<td>" . $row["emergency_contact"] . "</td>";
                echo "<td>";
                echo "<button class='btn btn-primary' onclick=\"approveData(" . $row["roll"] . ")\">Approve</button>";
                echo "<button class='bt btn btn-primary' onclick=\"rejectData(" . $row["roll"] . ")\">Declined</button>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='14'>No data found</td></tr>";
        }
        ?>
    </table>

    <script>
        function approveData(roll) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    alert("Data with roll number " + roll + " has been approved.");
                    location.reload();
                }
            };
            xhttp.open("POST", "approve.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("roll=" + roll);
        }
        function rejectData(roll) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    alert("Data with roll number " + roll + " has been rejected and deleted.");
                    location.reload();
                }
            };
            xhttp.open("POST", "reject.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("roll=" + roll);
        }
    </script>
    <div class="footer-copy-right">
        <div class="container">
            <div class="allah-copy">
                <p>Project by : Azhar hayat || Ali hassan || Zargham elahi</p>
            </div>
        </div>
    </div>
</body>
</html>