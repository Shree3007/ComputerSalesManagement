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
if (isset($_GET['sup_id']) && is_numeric($_GET['sup_id'])) {
    $sup_id = $_GET['sup_id'];

    // If confirmation is received, proceed with deletion
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        // Prepare and execute SQL DELETE statement
        $sql = "DELETE FROM supplier WHERE sup_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $sup_id);

        if ($stmt->execute()) {
            echo "Supplier deleted successfully.";
            header("location:supplier.php");
            exit;
        } else {
            echo "Error deleting Supplier: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        // If confirmation is not received, show confirmation dialog
        echo "<script>
                var confirmed = confirm('Are you sure you want to delete this Supplier?');
                if (confirmed) {
                    window.location.href = 'deleteSupplier.php?sup_id=$sup_id&confirm=yes';
                } else {
                    window.location.href = 'supplier.php';
                }
              </script>";
    }
} else {
    echo "Invalid Supplier ID.";
}

// Close connection
$connection->close();
?>
