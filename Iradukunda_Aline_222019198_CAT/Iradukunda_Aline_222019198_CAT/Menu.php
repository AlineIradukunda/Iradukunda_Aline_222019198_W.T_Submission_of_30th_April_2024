<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Menu</title>
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
  <h1><u>Menu Form</u></h1>
  <!-- Form to add a new menu item -->
  <form method="post">
    <label for="iid">Item ID:</label>
    <input type="number" id="iid" name="iid"><br><br>
    <label for="iname">Item Name:</label>
    <input type="text" id="iname" name="iname" required><br><br>
    <label for="prc">Price:</label>
    <input type="number" id="prc" name="prc" required><br><br>
    <input type="submit" name="add" value="Insert">
  </form>

  <?php
  include('database_connection.php');

  // Check if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Prepare and bind the parameters
      $stmt = $connection->prepare("INSERT INTO menu(Item_id, Item_Name, Price) VALUES (?, ?, ?)");
      $stmt->bind_param("iss", $iid, $iname, $prc);

      // Set parameters and execute
      $iid = $_POST['iid'];
      $iname = $_POST['iname'];
      $prc = $_POST['prc'];

      if ($stmt->execute() == TRUE) {
          echo "New record has been added successfully";
      } else {
          echo "Error: " . $stmt->error;
      }
      $stmt->close();
  }
  $connection->close();
  ?>

  <h2>Table of Menu</h2>
  <!-- Displaying menu records -->
  <table border="3">
    <tr>
      <th>Item ID</th>
      <th>Item Name</th>
      <th>Price</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    include('database_connection.php');

    // Prepare SQL query to retrieve all menu items
    $sql = "SELECT * FROM menu";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $iid = $row['Item_id'];
            echo "<tr>
                    <td>" . $row['Item_id'] . "</td>
                    <td>" . $row['Item_Name'] . "</td>
                    <td>" . $row['Price'] . "</td>
                    <td><a style='padding:4px' href='delete_Menu.php?Item_id=$iid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_Menu.php?Item_id=$iid'>Update</a></td> 
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No data found</td></tr>";
    }
    // Close the database connection
    $connection->close();
    ?>
  </table>
</section>

<footer>
  <center> 
    <b><h2>UR CBE BIT &copy; <?php echo date("Y"); ?> &reg;, Designer by: @ALINE IRADUKUNDA</h2></b>
  </center>
</footer>
</body>
</html>
