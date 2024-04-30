<?php
// Connection details
include('database_connection.php');

// Function to show delete confirmation modal
function showDeleteConfirmation($oid) {
    echo <<<HTML
    <div id="confirmModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this record?</p>
            <button onclick="confirmDeletion($oid)">Confirm</button>
            <button onclick="returnToOrders()">Back</button>
        </div>
    </div>
    <script>
    function confirmDeletion(oid) {
        window.location.href = '?Order_id=' + oid + '&confirm=yes';
    }
    function returnToOrders() {
        window.location.href = 'orders.php';
    }
    </script>
HTML;
}

// Check if Order_id is set
if(isset($_REQUEST['Order_id'])) {
    $oid = $_REQUEST['Order_id'];
    
    // Check for confirmation response
    if (isset($_REQUEST['confirm']) && $_REQUEST['confirm'] == 'yes') {
        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM orders WHERE Order_id=?");
        $stmt->bind_param("i", $oid);
        if ($stmt->execute()) {
            echo "<script>alert('Record deleted successfully.'); window.location.href = 'orders.php';</script>";
        } else {
            echo "<script>alert('Error deleting data: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        // Show confirmation dialog
        showDeleteConfirmation($oid);
    }
} else {
    echo "<script>alert('Order_id is not set.'); window.location.href = 'orders.php';</script>";
}

$connection->close();
?>