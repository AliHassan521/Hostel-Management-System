<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Room List</title>
    <style>
        /* Navbar styles */
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
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
    <h2 class="heading2">Room List</h2>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT room_number, capacity FROM rooms";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table class='table'>
              <thead>
                <tr>
                  <th>Room Number</th>
                  <th>Capacity</th>
                </tr>
              </thead>
              <tbody>";

        // Fetch each row of data and display it
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row["room_number"] . "</td>
                <td>" . $row["capacity"] . "</td>
              </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "No rooms found.";
    }
    $conn->close();
    ?>
    <div class="footer-copy-right">
        <div class="container">
            <div class="allah-copy">
                <p>Project by : Azhar hayat || Ali hassan || Zargham elahi</p>
            </div>
        </div>
    </div>

</body>

</html>