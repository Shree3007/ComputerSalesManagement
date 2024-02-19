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
if (isset($_GET['p_id']) && is_numeric($_GET['p_id'])) {
    $p_id = $_GET['p_id'];

    // If confirmation is received, proceed with deletion
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        // Prepare and execute SQL DELETE statement
        $sql = "DELETE FROM product WHERE p_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $p_id);

        if ($stmt->execute()) {
            echo "Product deleted successfully.";
            header("location:product.php");
            exit;
        } else {
            echo "Error deleting Product: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        // If confirmation is not received, show confirmation dialog
        echo "<script>
                var confirmed = confirm('Are you sure you want to delete this Product?');
                if (confirmed) {
                    window.location.href = 'deleteProduct.php?p_id=$p_id&confirm=yes';
                } else {
                    window.location.href = 'product.php';
                }
              </script>";
    }
} else {
    echo "Invalid Product ID.";
}

// Close connection
$connection->close();
?>
