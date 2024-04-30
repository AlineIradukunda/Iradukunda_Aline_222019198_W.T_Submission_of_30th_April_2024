<?php
include('database_connection.php');

// Function to show delete confirmation modal
function showDeleteConfirmation($eid) {
    echo <<<HTML
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDeletion(eid) {
                window.location.href = '?Employee_id=' + eid + '&confirm=yes';
            }
            function returnToEmployees() {
                window.location.href = 'Employee.php';
            }
        </script>
    </head>
    <body bgcolor="grey">
        <div id="confirmModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;">
            <div style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
                <h2>Confirm Deletion</h2>
                <p>Are you sure you want to delete this record?</p>
                <button onclick="confirmDeletion($eid)">Confirm</button>
                <button onclick="returnToEmployees()">Back</button>
            </div>
        </div>
    </body>
    </html>
HTML;
}

if(isset($_REQUEST['Employee_id'])) {
    $eid = $_REQUEST['Employee_id'];
    
    // Check for confirmation response
    if(isset($_REQUEST['confirm']) && $_REQUEST['confirm'] == 'yes') {
        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM employee WHERE Employee_id=?");
        $stmt->bind_param("i", $eid);
        
        try {
            if ($stmt->execute()) {
                echo "<script>alert('Record deleted successfully.'); window.location.href = 'Employee.php';</script>";
            } else {
                echo "<script>alert('Error deleting data.');</script>";
            }
        } catch (mysqli_sql_exception $e) {
            // Handle foreign key constraint error
            echo "<script>alert('Error deleting data: Cannot delete or update a parent row.');</script>";
        }
        
        $stmt->close();
    } else {
        // Show confirmation dialog
        showDeleteConfirmation($eid);
    }
} else {
    echo "<script>alert('Employee_id is not set.'); window.location.href = 'Employee.php';</script>";
}

$connection->close();
?>
