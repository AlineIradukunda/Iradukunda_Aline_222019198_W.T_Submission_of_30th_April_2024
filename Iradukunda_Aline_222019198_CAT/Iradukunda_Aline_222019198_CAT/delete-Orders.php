<?php
// Connection details
include('database_connection.php');
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if Orders_Id is set
if(isset($_REQUEST['Order_id'])) {
    $oid = $_REQUEST['Order_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM orders WHERE Order_id=?");
    $stmt->bind_param("i", $oid);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Order_id is not set.";
}

$connection->close();
?>
s