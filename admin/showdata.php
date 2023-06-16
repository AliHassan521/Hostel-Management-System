<head>
  <title>show data</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />

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
    <br>
    <form method="GET" action="">
      <div class="form-group">
        <input type="text" name="search" class="form-control" placeholder="Search by Roll or Name">
      </div>
      <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <br>
  </nav>

  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";

  $connection = mysqli_connect($servername, $username, $password, $dbname);
  if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
  }
  if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];

    $query = "SELECT a.room_number, a.roll, a.name 
            FROM approved a 
            LEFT JOIN rooms r ON a.room_number = r.room_number
            WHERE a.roll LIKE '%$searchTerm%' OR a.name LIKE '%$searchTerm%'";
  } else {
    $query = "SELECT a.room_number, a.roll, a.name FROM approved a LEFT JOIN rooms r ON a.room_number = r.room_number";
  }

  $result = mysqli_query($connection, $query);

  if ($result) {
    if (mysqli_num_rows($result) > 0) {
      echo '<table class="table">';
      echo '<thead class="thead-light">';
      echo '<tr>';
      echo '<th scope="col">Room Number</th>';
      echo '<th scope="col">Roll</th>';
      echo '<th scope="col">Name</th>';
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';

      while ($row = mysqli_fetch_assoc($result)) {
        $roomNumber = $row['room_number'];
        $roll = $row['roll'];
        $name = $row['name'];
        echo '<tr>';
        echo "<td>$roomNumber</td>";
        echo "<td>$roll</td>";
        echo "<td>$name</td>";
        echo '</tr>';
      }

      echo '</tbody>';
      echo '</table>';
    } else {
      echo "No data found.";
    }

    mysqli_free_result($result);
  } else {
    echo "Error executing the query: " . mysqli_error($connection);
  }

  mysqli_close($connection);
  ?>

  <div class="footer-copy-right">
    <div class="container">
      <div class="allah-copy">
        <p>Project by: Azhar Hayat || Ali Hassan || Zargham Elahi</p>
      </div>
    </div>
  </div>
</body>