<?php
include('database_connection.php');

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Function to show delete confirmation modal
function showDeleteConfirmation($rid) {
    echo <<<HTML
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Reservation</title>
        <script>
            function confirmDeletion(rid) {
                window.location.href = '?reservation_id=' + rid + '&confirm=yes';
            }
            function returnToReservations() {
                window.location.href = 'Reservation.php';
            }
        </script>
    </head>
    <body bgcolor="grey">
        <div id="confirmModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;">
            <div style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
                <h2>Confirm Deletion</h2>
                <p>Are you sure you want to delete this reservation?</p>
                <button onclick="confirmDeletion($rid)">Confirm</button>
                <button onclick="returnToReservations()">Back</button>
            </div>
        </div>
    </body>
    </html>
HTML;
}

// Check if reservation_id is set
if(isset($_REQUEST['reservation_id'])) {
    $rid = $_REQUEST['reservation_id'];
    
    // Check for confirmation response
    if(isset($_REQUEST['confirm']) && $_REQUEST['confirm'] == 'yes') {
        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM reservation WHERE reservation_id=?");
        $stmt->bind_param("i", $rid);
        
        if ($stmt->execute()) {
            echo "<script>alert('Reservation deleted successfully.'); window.location.href = 'Reservation.php';</script>";
        } else {
            echo "<script>alert('Error deleting reservation: " . $stmt->error . "');</script>";
        }
        
        $stmt->close();
    } else {
        // Show confirmation dialog
        showDeleteConfirmation($rid);
    }
} else {
    echo "<script>alert('Reservation ID is not set.'); window.location.href = 'Reservation.php';</script>";
}

$connection->close();
?>
