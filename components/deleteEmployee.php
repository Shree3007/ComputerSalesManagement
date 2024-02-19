<?php
// deleteCustomer.php

$servername = "localhost";
$username = "root";
$password = "";
$database = "computersales";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if cust_id is set and numeric
if (isset($_GET['emp_id']) && is_numeric($_GET['emp_id'])) {
    $emp_id = $_GET['emp_id'];

    // If confirmation is received, proceed with deletion
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        // Prepare and execute SQL DELETE statement
        $sql = "DELETE FROM employee WHERE emp_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $emp_id);

        if ($stmt->execute()) {
            echo "Employee deleted successfully.";
            header("location:employee.php");
            exit;
        } else {
            echo "Error deleting Employee: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        // If confirmation is not received, show confirmation dialog
        echo "<script>
                var confirmed = confirm('Are you sure you want to delete this Employee?');
                if (confirmed) {
                    window.location.href = 'deleteEmployee.php?emp_id=$emp_id&confirm=yes';
                } else {
                    window.location.href = 'employee.php';
                }
              </script>";
    }
} else {
    echo "Invalid Employee ID.";
}

// Close connection
$connection->close();
?>
