<?php
include('database_connection.php');

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Function to show delete confirmation modal
function showDeleteConfirmation($iid) {
    echo <<<HTML
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Item</title>
        <script>
            function confirmDeletion(iid) {
                window.location.href = '?Item_id=' + iid + '&confirm=yes';
            }
            function returnToMenu() {
                window.location.href = 'Menu.php';
            }
        </script>
    </head>
    <body bgcolor="grey">
        <div id="confirmModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;">
            <div style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
                <h2>Confirm Deletion</h2>
                <p>Are you sure you want to delete this item?</p>
                <button onclick="confirmDeletion($iid)">Confirm</button>
                <button onclick="returnToMenu()">Back</button>
            </div>
        </div>
    </body>
    </html>
HTML;
}

// Check if Item_id is set
if(isset($_REQUEST['Item_id'])) {
    $iid = $_REQUEST['Item_id'];
    
    // Check for confirmation response
    if(isset($_REQUEST['confirm']) && $_REQUEST['confirm'] == 'yes') {
        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM menu WHERE Item_id=?");
        $stmt->bind_param("i", $iid);
        
        if ($stmt->execute()) {
            echo "<script>alert('Item deleted successfully.'); window.location.href = 'Menu.php';</script>";
        } else {
            echo "<script>alert('Error deleting item: " . $stmt->error . "');</script>";
        }
        
        $stmt->close();
    } else {
        // Show confirmation dialog
        showDeleteConfirmation($iid);
    }
} else {
    echo "<script>alert('Item_id is not set.'); window.location.href = 'Menu.php';</script>";
}

$connection->close();
?>
