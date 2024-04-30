<?php
// Connection details
include('database_connection.php');

// Check connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if Employee_id is set
if(isset($_REQUEST['Employee_id'])) {
    $eid = $_REQUEST['Employee_id'];
    
    // Fetch employee details based on employee ID
    $stmt_employee = $connection->prepare("SELECT * FROM employee WHERE Employee_id = ?");
    $stmt_employee->bind_param("i", $eid);
    $stmt_employee->execute();
    $result_employee = $stmt_employee->get_result();
    
    if($result_employee->num_rows > 0) {
        $row_employee = $result_employee->fetch_assoc();
        $emp_name = $row_employee['Employee_name'];
        $address = $row_employee['Address'];
        $telephone = $row_employee['Telephone'];
        $email = $row_employee['Email'];
        $position = $row_employee['Position'];
    } else {
        echo "Employee not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="emp_name">Employee Name:</label>
        <input type="text" name="emp_name" value="<?php echo isset($emp_name) ? $emp_name : ''; ?>">
        <br><br>

        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo isset($address) ? $address : ''; ?>">
        <br><br>

        <label for="telephone">Telephone:</label>
        <input type="number" name="telephone" value="<?php echo isset($telephone) ? $telephone : ''; ?>">
        <br><br>

        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
        <br><br>

        <label for="position">Position:</label>
        <input type="text" name="position" value="<?php echo isset($position) ? $position : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
         <script>
        <?php if(isset($_POST['up'])): ?>
            alert("Update successful.");
            window.location.href = "Employee.php";
        <?php endif; ?>
    </script>
    </form>

    <?php
    if(isset($_POST['up'])) {
        // Retrieve updated values from form
        $emp_name = $_POST['emp_name'];
        $address = $_POST['address'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];
        $position = $_POST['position'];
        
        // Update the employee in the database
        $stmt_update_employee = $connection->prepare("UPDATE employee SET Employee_name=?, Address=?, Telephone=?, Email=?, Position=? WHERE Employee_id=?");
        $stmt_update_employee->bind_param("sssssi", $emp_name, $address, $telephone, $email, $position, $eid);
        $stmt_update_employee->execute();
        
        // Display popup message
        echo '<script>alert("Update successful.");</script>';
        
        // Redirect to employee.php
        // header('Location: employee.php');
        // exit(); // Ensure that no other content is sent after the header redirection
    }
    ?>
</body>
</html>
