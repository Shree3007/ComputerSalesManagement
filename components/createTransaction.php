<?php
$servername = "localhost";
$username = "root";
$password ="";
$database = "computersales";

$connection = new mysqli($servername, $username, $password, $database);

$p_id ="";
$cust_id ="";
$date ="";
$quantity ="";
$price ="";

$errorMessage = "";
$successMessage = "";

// Fetching product IDs from the product table
$productIds = [];
$sqlProduct = "SELECT p_id FROM product";
$resultProduct = $connection->query($sqlProduct);
if ($resultProduct->num_rows > 0) {
    while ($row = $resultProduct->fetch_assoc()) {
        $productIds[] = $row['p_id'];
    }
}

// Fetching customer IDs from the customers table
$customerIds = [];
$sqlCustomer = "SELECT cust_id FROM customers";
$resultCustomer = $connection->query($sqlCustomer);
if ($resultCustomer->num_rows > 0) {
    while ($row = $resultCustomer->fetch_assoc()) {
        $customerIds[] = $row['cust_id'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $p_id = $_POST["p_id"];
    $cust_id = $_POST["cust_id"];
    $date = $_POST["date"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];

    do {
        if (empty($p_id) || empty($cust_id) || empty($date) || empty($quantity) || empty($price)) {
            $errorMessage = "All the fields are required";
            break;
        }

        // Add transaction to db
        $sql = "INSERT INTO transactions(p_id, cust_id, date, quantity, price)" .
        "VALUES('$p_id','$cust_id','$date','$quantity','$price')";

        try {
            if ($connection->query($sql) === TRUE) {
                $successMessage = "Transaction added correctly";
                header("Location: transaction.php");
                exit;
            }
        } catch (mysqli_sql_exception $exception) {
            $errorMessage = "Warning: " . $exception->getMessage();
        }
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/Hstyle.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="body">
    <div class="container my-5"> 
        <h2>New Transaction</h2>

        <?php
        if(!empty($errorMessage)){
            echo "
            <div class='alert alert-warning' role='alert'>
                $errorMessage
            </div>";
        }

        if(!empty($successMessage)){
            echo "
            <div class='alert alert-success' role='alert'>
                $successMessage
            </div>";
        }
        ?>
        
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Product ID</label>
                <div class="col-sm-6">
                    <select class="form-select" name="p_id">
                        <option value="">Select Product ID</option>
                        <?php foreach ($productIds as $productId) : ?>
                            <option value="<?php echo $productId; ?>"><?php echo $productId; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Customer ID</label>
                <div class="col-sm-6">
                    <select class="form-select" name="cust_id">
                        <option value="">Select Customer ID</option>
                        <?php foreach ($customerIds as $customerId) : ?>
                            <option value="<?php echo $customerId; ?>"><?php echo $customerId; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="date" value="<?php echo $date; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Quantity</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="quantity" value="<?php echo $quantity; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Price</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="price" value="<?php echo $price; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="transaction.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
