<!DOCTYPE html>
<html>

<head>
    <title>Display Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>

        .table {
            margin-top: 20px;
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
    <div class="container">
        <h2 class="heading2">Display Data</h2>
        <?php
        $hostname = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'test';
        $conn = new mysqli($hostname, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["submit_fee"])) {
                $roll = $_POST["submit_fee"];

                $update_query = "UPDATE fee SET fee = 0, status = 'Paid' WHERE roll = '$roll'";
                $conn->query($update_query);
            } elseif (isset($_POST["add_fine"])) {
                $roll = $_POST["add_fine"];
                $fine = $_POST["fine_amount"];

                $update_query = "UPDATE fee SET fee = fee + $fine, status = 'Unpaid' WHERE roll = '$roll'";
                $conn->query($update_query);
            } elseif (isset($_POST["send_semester_fee"])) {
                
                $update_query = "UPDATE fee SET fee = fee + 2000, status = 'Unpaid'";
                $conn->query($update_query);
            }
        }

        $query = "SELECT approved.roll, approved.name, fee.fee, fee.status
                  FROM approved
                  INNER JOIN fee ON approved.roll = fee.roll";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
        ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Roll</th>
                        <th>Name</th>
                        <th>Fee</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Add Fine</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $row['roll']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['fee']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="submit_fee" value="<?php echo $row['roll']; ?>">
                                    <button type="submit" class="btn btn-primary">Submit Fee</button>
                                </form>
                            </td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="add_fine" value="<?php echo $row['roll']; ?>">
                                    <input type="number" name="fine_amount" placeholder="Enter Fine Amount" required>
                                    <button type="submit" class="btn btn-primary">Add Fine</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        } else {
            echo "No records found.";
        }
        $conn->close();
        ?>
        <form method="post">
            <button type="submit" name="send_semester_fee" class="btn btn-primary">Send Semester Fee</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <div class="footer-copy-right">
        <div class="container">
            <div class="allah-copy">
                <p>Project by : Azhar hayat || Ali hassan || Zargham elahi</p>
            </div>
        </div>
    </div>
</body>

</html>