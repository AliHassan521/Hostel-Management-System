<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM approved";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["allotRoom"])) {
    $roll = $_POST["roll"];
    $password = $_POST["password"];

    $loginSql = "INSERT INTO login_info (roll, password) VALUES ('$roll', '$password')";
    if ($conn->query($loginSql) === true) {
        echo "Registration successful. You can now log in.";
    } else {
        echo "Error: " . $loginSql . "<br>" . $conn->error;
    }
    $roomSql = "SELECT room_number, capacity FROM rooms";
    $roomResult = $conn->query($roomSql);
    if ($roomResult->num_rows > 0) {
        echo "<div>Please select a room:</div>";
        echo "<form action='' method='post' class='my-form'>";
        echo "<select name='roomNumber'>";
        while ($row = $roomResult->fetch_assoc()) {
            $roomNumber = $row["room_number"];
            $capacity = $row["capacity"];
            echo "<option value='$roomNumber'>Room $roomNumber (Capacity: $capacity)</option>";
        }
        echo "</select>";
        echo "<input type='hidden' name='roll' value='$roll'>";
        echo "<input type='hidden' name='password' value='$password'>";
        echo "<input type='submit' name='selectRoom' value='Select Room'>";
        echo "</form>";
    } else {
        echo "No rooms available.<br>";
    }
}

        // Check if room deallocation button is pressed
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deallocateRoom"])) {
            $roll = $_POST["roll"];

            $deallocateSql = "UPDATE approved SET room_number='' WHERE roll='$roll'";
            if ($conn->query($deallocateSql) === TRUE) {
                echo "Room deallocated successfully for Roll $roll.";
            } else {
                echo "Error deallocating room: " . $conn->error;
            }
        }


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["selectRoom"])) {
    $roomNumber = $_POST["roomNumber"];
    $roll = $_POST["roll"];
    $capacitySql = "SELECT capacity FROM rooms WHERE room_number='$roomNumber'";
    $capacityResult = $conn->query($capacitySql);
    $capacity = 0;
    if ($capacityResult->num_rows > 0) {
        $row = $capacityResult->fetch_assoc();
        $capacity = $row["capacity"];
    }

    // Count the number of approved students in the selected room
    $occupancySql = "SELECT COUNT(*) AS occupancy FROM approved WHERE room_number='$roomNumber'";
    $occupancyResult = $conn->query($occupancySql);
    $currentOccupancy = 0;
    if ($occupancyResult->num_rows > 0) {
        $row = $occupancyResult->fetch_assoc();
        $currentOccupancy = $row["occupancy"];
    }

    if ($currentOccupancy >= $capacity) {
        echo "Room $roomNumber is already full. Please select another room.";
    } else {
        $updateSql = "UPDATE approved SET room_number='$roomNumber' WHERE roll='$roll'";
        if ($conn->query($updateSql) === TRUE) {
            echo "Room $roomNumber selected successfully for Roll $roll.";
        } else {
            echo "Error selecting room: " . $conn->error;
        }
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Approved Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <style>
        table {
            border-collapse: collapse;
            width: auto;
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

        body {
            width: fit-content;
        }

        .my-form {
        
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f2f2f2;
        }

        .my-form select {
            
            width: 200px;
            padding: 5px;
            border: 1px solid #ccc;
        }

        .my-form input[type='hidden'] {
            /* CSS rules for hidden input fields */
            /* Example styles: */
            display: none;
            border-radius: 10px;
        }

        .my-form input[type='submit'] {
            /* CSS rules for the submit button */
            /* Example styles: */
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            margin-left: 10px;
            border-radius: 10px;
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

    <h2 class="heading2">Approved Students</h2>
    <table>
        <tr>
            <th>Ecat Roll Number</th>
            <th>Name</th>
            <th>room</th>
            <th>CNIC</th>
            <th>Password</th>
            <th>Birth Date</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Aggregate</th>
            <th>Department</th>
            <th>Address</th>
            <th>City</th>
            <th>Emergency Contact</th>
            <th>Allot Room</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $roomNumber = $row["room_number"];
                $isRoomAllotted = !empty($roomNumber);

                $rowStyle = $isRoomAllotted ? 'background-color: yellow;' : '';

                echo "<tr style='$rowStyle'>";
                echo "<td>" . $row["roll"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $roomNumber . "</td>";
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
                echo "<td>
                            <form action='' method='post'>
                                <input type='hidden' name='roll' value='" . $row["roll"] . "'>
                                <input type='hidden' name='password' value='" . $row["password"] . "'>
                                <input type='submit' name='allotRoom' value='Allot Room'>
                            </form>
                      </td>";
                echo "<td>
        <form action='' method='post'>
            <input type='hidden' name='roll' value='" . $row["roll"] . "'>
            <input type='hidden' name='password' value='" . $row["password"] . "'>
            <input type='submit' name='deallocateRoom' value='Deallocate Room'>
        </form>
    </td>";

                echo "</tr>";

            }
        } else {
            echo "<tr><td colspan='13'>No data found for approved students</td></tr>";
        }
        ?>
    </table>
    <br><br><br>
    <div class="footer-copy-right">
        <!-- Footer content -->

        <div class="container">
            <div class="allah-copy">
                <p>Project by : Azhar hayat || Ali hassan || Zargham elahi</p>
            </div>
        </div>

    </div>
</body>


</html>

</html>