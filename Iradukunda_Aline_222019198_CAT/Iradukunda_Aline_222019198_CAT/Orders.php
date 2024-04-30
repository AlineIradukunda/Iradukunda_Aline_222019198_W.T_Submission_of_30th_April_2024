<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Orders</title>
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
    <li style="display: inline; margin-right: 10px;">
      <img src="./Images/aa.jpg" width="90" height="60" alt="Logo">
    </li>
    <!-- Menu items -->
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./customer.php">CUSTOMER</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./employee.php">EMPLOYEE</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./menu.php">MENU</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./orders.php">ORDERS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./reservation.php">RESERVATION</a></li>
    
    <!-- Dropdown for settings -->
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
  <h1><u>Orders Form</u></h1>
  <!-- Form to add a new order -->
  <form method="post">
    <label for="oid">Order ID:</label>
    <input type="number" id="oid" name="oid"><br><br>
    <label for="iid">Item ID:</label>
    <input type="number" id="iid" name="iid" required><br><br>
    <label for="cid">Customer ID:</label>
    <input type="number" id="cid" name="cid" required><br><br>
    <label for="eid">Employee ID:</label>
    <input type="number" id="eid" name="eid" required><br><br>
    <label for="qty">Quantity:</label>
    <input type="number" id="qty" name="qty" required><br><br>
    <label for="ot">Order Time:</label>
    <input type="number" id="ot" name="ot" required><br><br>
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
      $stmt = $connection->prepare("INSERT INTO orders(Order_id, item_id, customer_id, employee_id, quantity, order_time) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("iiiiii", $oid, $iid, $cid, $eid, $qty, $ot);
      // Set parameters and execute
      $oid = $_POST['oid'];
      $iid = $_POST['iid'];
      $cid = $_POST['cid'];
      $eid = $_POST['eid'];
      $qty = $_POST['qty'];
      $ot = $_POST['ot'];

      if ($stmt->execute() == TRUE) {
          echo "New record has been added successfully";
      } else {
          echo "Error: " . $stmt->error;
      }
      $stmt->close();
  }
  $connection->close();
  ?>

  <!-- Table to display orders -->
  <center><h2>Table of Orders</h2></center>
  <table border="3">
    <tr>
      <th>Order ID</th>
      <th>Item ID</th>
      <th>Customer ID</th>
      <th>Employee ID</th>
      <th>Quantity</th>
      <th>Order Time</th>
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

    // Prepare SQL query to retrieve all orders
    $sql = "SELECT * FROM orders";
    $result = $connection->query($sql);

    // Check if there are any orders
    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            $oid = $row['Order_id']; // Fetch the Order ID
            echo "<tr>
                    <td>" . $row['Order_id'] . "</td>
                    <td>" . $row['item_id'] . "</td>
                    <td>" . $row['customer_id'] . "</td>
                    <td>" . $row['employee_id'] . "</td>
                    <td>" . $row['quantity'] . "</td>
                    <td>" . $row['order_time'] . "</td>
                    <td><a style='padding:4px' href='delete_Orders.php?Order_id=$oid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_Orders.php?Order_id=$oid'>Update</a></td> 
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No data found</td></tr>";
    }
    // Close the database connection
    $connection->close();
    ?>
  </table>
</section>

<footer>
  <center>
    <b><h2>UR CBE BIT &copy; <?php echo date("Y"); ?> &reg;, Designed by: @ALINE IRADUKUNDA</h2></b>
  </center>
</footer>
</body>
</html>
