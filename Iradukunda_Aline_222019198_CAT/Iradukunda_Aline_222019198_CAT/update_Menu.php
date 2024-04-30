<?php
// Connection details
include('database_connection.php');
// Check connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if Item_id is set
if(isset($_REQUEST['Item_id'])) {
    $iid = $_REQUEST['Item_id'];
    
    $stmt = $connection->prepare("SELECT * FROM menu WHERE Item_id=?");
    $stmt->bind_param("i", $iid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['Item_id'];
        $y = $row['Item_Name'];
        $z = $row['Price'];
       
    } else {
        echo "Item not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="iname">Item_Name:</label>
        <input type="text" name="iname" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="prc">Price:</label>
        <input type="text" name="prc" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>

    <script>
        <?php if(isset($_POST['up'])): ?>
            alert("Update successful.");
            window.location.href = "Menu.php";
        <?php endif; ?>
    </script>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $Item_Name = $_POST['iname'];
    $Price = $_POST['prc'];
    
    
    // Update the product in the database
    $stmt = $connection->prepare("UPDATE menu SET Item_Name=?, Price=? WHERE Item_id=?");
    $stmt->bind_param("sdi", $Item_Name, $Price, $iid);
    $stmt->execute();
    
    // Redirect to Menu.php
    // header('Location: Menu.php');
    // exit(); // Ensure that no other content is sent after the header redirection
}
?>
