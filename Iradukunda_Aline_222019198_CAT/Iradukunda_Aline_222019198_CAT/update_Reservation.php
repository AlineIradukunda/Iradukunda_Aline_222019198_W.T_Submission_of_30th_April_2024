<?php
// Connection details
include('database_connection.php');
// Check connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if Product_Id is set
if(isset($_REQUEST['reservation_id'])) {
    $rid = $_REQUEST['reservation_id'];
    
    $stmt = $connection->prepare("SELECT * FROM reservation WHERE reservation_id=?");
    $stmt->bind_param("i", $rid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['reservation_id'];
        $y = $row['customer_id'];
        $z = $row['reservation_time'];
        $w = $row['table_number'];
    
    } else {
        echo "Reservation not found.";
    }
}
?>

<html>
<body>
    <form method="POST" id="updateForm">
        <label for="cid">Customer Id:</label>
        <input type="number" name="cid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="rt">Reservation Time:</label>
        <input type="number" name="rt" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="tn">Table Number:</label>
        <input type="number" name="tn" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>


        <input type="submit" name="up" value="Update">
        
    </form>

    <script>
        <?php if(isset($_POST['up'])): ?>
            alert("Update successful.");
            window.location.href = "Reservation.php";
        <?php endif; ?>
    </script>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $customer_id = $_POST['cid'];
    $reservation_time = $_POST['rt'];
    $table_number = $_POST['tn'];
   
    
    // Update the product in the database
    $stmt = $connection->prepare("UPDATE reservation SET customer_id=?, reservation_time=?, table_number=? WHERE reservation_id=?");
    $stmt->bind_param("ssss", $customer_id, $reservation_time, $table_number, $rid);
    $stmt->execute();
    
    // Redirect to product.php
    // header('Location: Reservation.php');
    // exit(); // Ensure that no other content is sent after the header redirection
}
?>
