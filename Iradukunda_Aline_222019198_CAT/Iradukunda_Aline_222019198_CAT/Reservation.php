<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Reservation</title>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
   <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: white;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: green;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1200px; /* Adjust this value as needed */

      padding: 8px;
     
    }
    section{
    padding:71px;
    border-bottom: 1px solid #ddd;
    }
    footer{
    text-align: center;
    padding: 15px;
    background-color:darkgray;
    }
        table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

  </style>
</head>
<body bgcolor="#6B6B6B">

<header>
  <form class="d-flex" role="search" action="search.php">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;"><img src="./Images/aa.jpg" width="90" height="60" alt="Logo"></li>
    <!-- Navigation links -->
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./customer.php">CUSTOMER</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./employee.php">EMPLOYEE</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./menu.php">MENU</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./orders.php">ORDERS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./reservation.php">RESERVATION</a></li>
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li>
  </ul>
</header>

<section>
  <h1><u>Reservation Form</u></h1>
  <form method="post">
    <label for="rid">Reservation ID:</label>
    <input type="number" id="rid" name="rid"><br><br>

    <label for="cid">Customer ID:</label>
    <input type="number" id="cid" name="cid" required><br><br>

    <label for="rt">Reservation Time:</label>
    <input type="text" id="rt" name="rt" required><br><br>

    <label for="tn">Table Number:</label>
    <input type="number" id="tn" name="tn" required><br><br>
    
    <input type="submit" name="add" value="Insert">
  </form>

  <?php
  // Connection details
 include('database_connection.php');
  // Check connection
  if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
  }

  // Check if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Prepare and bind the parameters
      $stmt = $connection->prepare("INSERT INTO reservation(reservation_id, customer_id, reservation_time, table_number) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("isss", $rid, $cid, $rt, $tn);
      // Set parameters and execute
      $rid = $_POST['rid'];
      $cid = $_POST['cid'];
      $rt = $_POST['rt'];
      $tn = $_POST['tn'];
      if ($stmt->execute() == TRUE) {
          echo "New record has been added successfully";
      } else {
          echo "Error: " . $stmt->error;
      }
      $stmt->close();
  }
  $connection->close();
  ?>

  <center><h2>Table of Reservation</h2></center>
  <table border="3">
    <tr>
      <th>Reservation ID</th>
      <th>Customer ID</th>
      <th>Reservation Time</th>
      <th>Table Number</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    // Establish a new connection
  include('database_connection.php');
    // Check if connection was successful
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Prepare SQL query to retrieve all reservations
    $sql = "SELECT * FROM reservation";
    $result = $connection->query($sql);

    // Check if there are any reservations
    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            $rid = $row['reservation_id']; // Fetch the Reservation ID
            echo "<tr>
              <td>" . $row['reservation_id'] . "</td>
              <td>" . $row['customer_id'] . "</td>
              <td>" . $row['reservation_time'] . "</td>
              <td>" . $row['table_number'] . "</td>
              <td><a style='padding:4px' href='delete_Reservation.php?reservation_id=$rid'>Delete</a></td> 
              <td><a style='padding:4px' href='update_Reservation.php?reservation_id=$rid'>Update</a></td> 
            </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No data found</td></tr>";
    }
    // Close the database connection
    $connection->close();
    ?>
  </table>
</section>

<footer>
  <center><b><h2>UR CBE BIT &copy; <?php echo date("Y"); ?> &reg; Designed by: @ALINE IRADUKUNDA</h2></b></center>
</footer>

</body>
</html>
