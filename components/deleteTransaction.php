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
if (isset($_GET['tr_id']) && is_numeric($_GET['tr_id'])) {
    $tr_id = $_GET['tr_id'];

    // If confirmation is received, proceed with deletion
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        // Prepare and execute SQL DELETE statement
        $sql = "DELETE FROM transactions WHERE tr_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $tr_id);

        if ($stmt->execute()) {
            echo "Transaction deleted successfully.";
            header("location:transaction.php");
            exit;
        } else {
            echo "Error deleting Transaction: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        // If confirmation is not received, show confirmation dialog
        echo "<script>
                var confirmed = confirm('Are you sure you want to delete this Transaction?');
                if (confirmed) {
                    window.location.href = 'deletetransaction.php?tr_id=$tr_id&confirm=yes';
                } else {
                    window.location.href = 'transaction.php';
                }
              </script>";
    }
} else {
    echo "Invalid transaction ID.";
}

// Close connection
$connection->close();
?>
