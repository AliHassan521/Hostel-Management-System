<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM complaints";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel - Complaints</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>

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
        <h2 class="heading2">Admin Panel - Complaints</h2>
        <?php if ($result->num_rows > 0) : ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Complaint ID</th>
                        <th>Roll Number</th>
                        <th>Registration Number</th>
                        <th>Complaint</th>
                        <th>Reply</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($complaint = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $complaint['id']; ?></td>
                            <td><?php echo $complaint['roll']; ?></td>
                            <td><?php echo $complaint['registration_number']; ?></td>
                            <td><?php echo $complaint['complain']; ?></td>
                            <td>
                                <?php if (!empty($complaint['reply'])) : ?>
                                    <?php echo $complaint['reply']; ?>
                                <?php else : ?>
                                    <form action="reply.php" method="POST">
                                        <input type="hidden" name="complaint_id" value="<?php echo $complaint['id']; ?>">
                                        <textarea name="reply" rows="2" cols="30"></textarea>
                                        <button type="submit" class="btn btn-primary btn-sm">Reply</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                            <td>
                                <form action="delete.php" method="POST">
                                    <input type="hidden" name="complaint_id" value="<?php echo $complaint['id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

        <?php else : ?>
            <p>No complaints found.</p>
        <?php endif; ?>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <div class="footer-copy-right">
        <div class="container">
            <div class="allah-copy">
                <p>Project by : Azhar hayat || Ali hassan || Zargham elahi</p>
            </div>
        </div>
    </div>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>