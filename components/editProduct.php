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

if(isset($_GET['p_id'])) {
    $p_id = $_GET['p_id'];

    // Now you can use $cust_id to fetch the customer details for editing
    // For example:
    $sql = "SELECT * FROM product WHERE p_id = $p_id";
    $result = $connection->query($sql);

    if(!$result || $result->num_rows == 0) {
        echo "Customer not found.";
        exit;
    }

    // Fetch the customer details
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $category = $row['category'];
    $description = $row['description'];
    $stock = $row['stock'];
    $price = $row['price'];
    $sup_id = $row['sup_id'];

} else {
    echo "Product ID not provided.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];
    $sup_id = $_POST['sup_id'];

    // Update customer details in the database
    $sql_update = "UPDATE product SET name='$name', category='$category', description='$description', stock='$stock', price='$price', sup_id='$sup_id' WHERE p_id=$p_id";

    if ($connection->query($sql_update) === TRUE) {
        echo "Product details updated successfully.";
        header("location:product.php");
         exit;
    } else {
        echo "Error updating product details: " . $connection->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Edit product</title>
</head>
<body>
    <div class="container my-5">
        <h2>Edit product</h2>
        <!-- Form for editing customer details -->
        <form method="post">
            <input type="hidden" name="p_id" value="<?php echo $p_id; ?>">
            <!-- Add form fields for editing customer details here -->
            <div class="mb-3">
                <label for="name" class="form-label"> Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control" id="category" name="category" value="<?php echo $category; ?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descriptionr</label>
                <input type="text" class="form-control" id="description" name="description" value="<?php echo $description; ?>">
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="text" class="form-control" id="stock" name="stock" value="<?php echo $stock; ?>">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" value="<?php echo $price; ?>">
            </div>
            <div class="mb-3">
                <label for="sup_id" class="form-label">Sup_ID</label>
                <input type="text" class="form-control" id="sup_id" name="sup_id" value="<?php echo $sup_id; ?>">
            </div>
            <!-- Add more fields as needed -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
