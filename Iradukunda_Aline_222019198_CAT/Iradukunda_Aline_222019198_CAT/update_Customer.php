<?php
// Connection details
include('database_connection.php');

// Check connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if Customer_id is set
if(isset($_REQUEST['Customer_id'])) {
    $cid = $_REQUEST['Customer_id'];
    
    // Fetch customer details based on customer ID
    $stmt_customer = $connection->prepare("SELECT * FROM customer WHERE Customer_id = ?");
    $stmt_customer->bind_param("i", $cid);
    $stmt_customer->execute();
    $result_customer = $stmt_customer->get_result();
    
    if($result_customer->num_rows > 0) {
        $row_customer = $result_customer->fetch_assoc();
        $cname = $row_customer['Customer_name'];
        $adrss = $row_customer['Address'];
        $tlphn = $row_customer['Telephone'];
        $eml = $row_customer['Email'];
    
    } else {
        echo "Customer not found.";
    }
}
?>

<html>
<body>
    <form method="POST" id="updateForm">
        <label for="cname">Customer Name:</label>
        <input type="text" name="cname" value="<?php echo isset($cname) ? $cname : ''; ?>">
        <br><br>

        <label for="adrss">Address:</label>
        <input type="text" name="adrss" value="<?php echo isset($adrss) ? $adrss : ''; ?>">
        <br><br>

        <label for="tlphn">Telephone:</label>
        <input type="number" name="tlphn" value="<?php echo isset($tlphn) ? $tlphn : ''; ?>">
        <br><br>

        <label for="eml">Email:</label>
        <input type="text" name="eml" value="<?php echo isset($eml) ? $eml : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>

    <script>
        <?php if(isset($_POST['up'])): ?>
            alert("Update successful.");
            window.location.href = "customer.php";
        <?php endif; ?>
    </script>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $Customer_name = $_POST['cname'];
    $Address = $_POST['adrss'];
    $Telephone = $_POST['tlphn'];
    $Email = $_POST['eml'];
    
    // Update the customer in the database
    $stmt_update_customer = $connection->prepare("UPDATE customer SET Customer_name=?, Address=?, Telephone=?, Email=? WHERE Customer_id=?");
    $stmt_update_customer->bind_param("ssdsi", $Customer_name, $Address, $Telephone, $Email, $cid);
    $stmt_update_customer->execute();
    
    // Display popup message
    echo '<script>alert("Update successful.");</script>';
    
    // Redirect to customer.php
    // header('Location: customer.php');
    // exit(); // Ensure that no other content is sent after the header redirection
}
?>
