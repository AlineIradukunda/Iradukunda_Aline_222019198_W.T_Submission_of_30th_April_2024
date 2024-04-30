<?php
// Connection details
include('database_connection.php');
// Check connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if Order_id is set
if(isset($_REQUEST['Order_id'])) {
    $oid = $_REQUEST['Order_id'];
    
    $stmt = $connection->prepare("SELECT * FROM orders WHERE Order_id=?");
    $stmt->bind_param("i", $oid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['Order_id'];
        $y = $row['item_id'];
        $z = $row['customer_id'];
        $w = $row['employee_id'];
        $s = $row['quantity'];
        $v = $row['order_time'];
    } else {
        echo "Orders not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
       <label for="iid">item_id:</label>
        <input type="text" name="iid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

       <label for="cid">customer_id:</label>
        <input type="text" name="cid" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="eid">employee_id:</label>
        <input type="number" name="eid" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="qty">quantity:</label>
        <input type="text" name="qty" value="<?php echo isset($s) ? $s : ''; ?>">
        <br><br>

          <label for="ot">order_time:</label>
        <input type="text" name="ot" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>

    <script>
        <?php if(isset($_POST['up'])): ?>
            alert("Update successful.");
            window.location.href = "Orders.php";
        <?php endif; ?>
    </script>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $item_id = $_POST['iid'];
    $customer_id = $_POST['cid'];
    $employee_id = $_POST['eid'];
    $quantity = $_POST['qty'];
    $order_time= $_POST['ot'];
    
    // Update the order in the database
    $stmt = $connection->prepare("UPDATE orders SET item_id=?, customer_id=?, employee_id=?, quantity=?, order_time=? WHERE Order_id=?");
    $stmt->bind_param("ssdiss", $item_id, $customer_id, $employee_id, $quantity, $order_time, $oid);
    $stmt->execute();
    
    // Redirect to orders.php
    // header('Location: Orders.php');
    // exit(); // Ensure that no other content is sent after the header redirection
}
?>
