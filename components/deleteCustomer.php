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
if (isset($_GET['cust_id']) && is_numeric($_GET['cust_id'])) {
    $cust_id = $_GET['cust_id'];

    // If confirmation is received, proceed with deletion
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        // Prepare and execute SQL DELETE statement
        $sql = "DELETE FROM customers WHERE cust_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $cust_id);

        if ($stmt->execute()) {
            echo "Customer deleted successfully.";
            header("location:customers.php");
            exit;
        } else {
            echo "Error deleting customer: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        // If confirmation is not received, show confirmation dialog
        echo "<script>
                var confirmed = confirm('Are you sure you want to delete this customer?');
                if (confirmed) {
                    window.location.href = 'deleteCustomer.php?cust_id=$cust_id&confirm=yes';
                } else {
                    window.location.href = 'customers.php';
                }
              </script>";
    }
} else {
    echo "Invalid customer ID.";
}

// Close connection
$connection->close();
?>
