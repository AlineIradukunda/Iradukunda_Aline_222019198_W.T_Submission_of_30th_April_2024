<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Customer</title>
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

  <header>

<body bgcolor="#6B6B6B">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
   <li style="display: inline; margin-right: 10px;">
    <img src="./Images/aa.jpg" width="90" height="60" alt="Logo">
  </li>
   <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./customer.php">CUSTOMER</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./employee.php">EMPLOYEE</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./menu.php">MENU</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./orders.php">ORDERS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./reservation.php">RESERVATION</a>
  </li>
   
  
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>

    <h1><u> customer Form </u></h1>
    <form method="post">
            
        <label for="cid">Customer_id:</label>
        <input type="number" id="cid" name="cid"><br><br>

        <label for="cname">Customer_name:</label>
        <input type="text" id="cname" name="cname" required><br><br>

        <label for="adrss">Address:</label>
        <input type="text" id="adrss" name="adrss" required><br><br>

        <label for="tlphn">Telephone:</label>
        <input type="number" id="tlphn" name="tlphn" required><br><br>

        <label for="eml">Email:</label>
        <input type="text" id="eml" name="eml" required><br><br>

        

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
    $stmt = $connection->prepare("INSERT INTO customer(Customer_id, Customer_name, Address, Telephone, Email) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $cid, $cname, $adrss, $tlphn, $eml);
    // Set parameters and execute
    $cid = $_POST['cid'];
    $cname = $_POST['cname'];
    $adrss = $_POST['adrss'];
    $tlphn = $_POST['tlphn'];
    $eml = $_POST['eml'];
    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>

<?php
// Connection details
include('database_connection.php');
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
// SQL query to fetch data from the customer table
$sql = "SELECT * FROM customer";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information of customer</title>
    <style>
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
<body>
    <center><h2>Table of customer</h2></center>
    <table border="5">
        <tr>
            <th>Customer_id</th>
            <th>Customer_name </th>
            <th>Address</th>
            <th>Telephone</th>
            <th>Email</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Define connection parameters
      include('database_connection.php');
        // Check if connection was successful
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Prepare SQL query to retrieve all customer
        $sql = "SELECT * FROM customer";
        $result = $connection->query($sql);

        // Check if there are any customer
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $cid = $row['Customer_id']; // Fetch the Customer_Id
                echo "<tr>
                    <td>" . $row['Customer_id'] . "</td>
                    <td>" . $row['Customer_name'] . "</td>
                    <td>" . $row['Address'] . "</td>
                    <td>" . $row['Telephone'] . "</td>
                    <td>" . $row['Email'] . "</td>
                    <td><a style='padding:4px' href='delete_Customer.php?Customer_id=$cid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_Customer.php?Customer_id=$cid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
</body>

    </section>


  
<footer>
  <center> 
    <b><h2>Designed by: @ALINE IRADUKUNDA</h2></b>
  </center>
</footer>
</body>
</html>