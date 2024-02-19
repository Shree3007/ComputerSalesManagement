<?php
// editcustomers.php

$servername = "localhost";
$username = "root";
$password ="";
$database = "computersales";

$connection = new mysqli($servername, $username, $password, $database);

if($connection->connect_error){
    die("Connection Failed: " . $connection->connect_error);
}

if(isset($_GET['tr_id'])) {
    $tr_id = $_GET['tr_id'];

    // Now you can use $cust_id to fetch the customer details for editing
    // For example:
    $sql = "SELECT * FROM transactions WHERE tr_id = $tr_id";
    $result = $connection->query($sql);

    if(!$result || $result->num_rows == 0) {
        echo "Customer not found.";
        exit;
    }

    // Fetch the customer details
    $row = $result->fetch_assoc();
    $p_id = $row['p_id'];
    $cust_id = $row['cust_id'];
    $date = $row['date'];
    $quantity = $row['quantity'];
    $price = $row['price'];

} else {
    echo "Transaction ID not provided.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $p_id = $_POST['p_id'];
    $cust_id = $_POST['cust_id'];
    $date = $_POST['date'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    // Update customer details in the database
    $sql_update = "UPDATE transactions SET p_id='$p_id', cust_id='$cust_id', date='$date', quantity='$quantity', price='$price' WHERE tr_id=$tr_id";

    if ($connection->query($sql_update) === TRUE) {
        echo "Transaction details updated successfully.";
        header("location:transaction.php");
         exit;
    } else {
        echo "Error updating transaction details: " . $connection->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Edit transaction</title>
</head>
<body>
    <div class="container my-5">
        <h2>Edit transaction</h2>
        <!-- Form for editing customer details -->
        <form method="post">
            <input type="hidden" name="tr_id" value="<?php echo $tr_id; ?>">
            <!-- Add form fields for editing customer details here -->
            <div class="mb-3">
                <label for="p_id" class="form-label">Product ID</label>
                <input type="text" class="form-control" id="p_id" name="p_id" value="<?php echo $p_id; ?>">
            </div>
            <div class="mb-3">
                <label for="cust_id" class="form-label">Customer ID</label>
                <input type="text" class="form-control" id="cust_id" name="cust_id" value="<?php echo $cust_id; ?>">
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="text" class="form-control" id="date" name="date" value="<?php echo $date; ?>">
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo $quantity; ?>">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" value="<?php echo $price; ?>">
            </div>
            <!-- Add more fields as needed -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
