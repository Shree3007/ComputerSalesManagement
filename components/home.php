<?php
// customersCount.php

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

// Query to get the count of customers
$sql = "SELECT COUNT(*) AS customer_count FROM customers";
$result = $connection->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $customer_count = $row['customer_count'];
} else {
    $customer_count = 0;
}

$sql = "SELECT COUNT(*) AS employee_count FROM employee";
$result = $connection->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $employee_count = $row['employee_count'];
} else {
    $employee_count = 0;
}

$sql = "SELECT COUNT(*) AS product_count FROM product";
$result = $connection->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $product_count = $row['product_count'];
} else {
    $product_count = 0;
}

$sql = "SELECT COUNT(*) AS supplier_count FROM supplier";
$result = $connection->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $supplier_count = $row['supplier_count'];
} else {
    $supplier_count = 0;
}
$sql = "SELECT COUNT(*) AS transactions_count FROM transactions";
$result = $connection->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $transactions_count = $row['transactions_count'];
} else {
    $transactions_count = 0;
}

// Close connection
$connection->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
  /* CSS styles */
  .container1 {
    display: flex;
    justify-content: space-between;
    transition: all 0.5s ease-in-out; /* Adding transition to the container */
  }
  .box1 {
    width: calc(30% - 20px); /* Adjusting the width to account for margin */
    padding: 20px;
    border: 2px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    background-color:#858786;
    transition: all 0.3s ease-in-out; /* Adding transition to the boxes */
  }
  .box1:hover {
    transform: scale(1.05); /* Scaling up the box on hover */
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); /* Adding a stronger shadow on hover */
  }
  .box1 h2 {
    text-align: center;
    margin-bottom: 10px;
    transition: color 0.3s ease-in-out; /* Adding transition to the heading color */
  }
  .box1 p {
    transition: color 0.3s ease-in-out; /* Adding transition to the paragraph color */
  }
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../styles/Hstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body{
            background-color: #C7B7A1;
        }
    </style>
</head>
<body class="body">

    <div id="sidebar"><li>
        <header><a href="home.php">
            <i class="fa-solid fa-computer"></i>
            <span>Home</span>
        </a>
    </header></li>
        <ul>
            <li>
                <a href="customers.php">
                    <i class="fa-solid fa-users"></i>
                    <span>Customers</span>
                </a>
            </li>
            <li>
                <a href="employee.php">
                    <i class="fa-solid fa-user-large"></i>
                    <span>Employee</span>
                </a>
            </li>
            <li>
                <a href="product.php">
                    <i class="fa-solid fa-laptop"></i>
                    <span>Product</span>
                </a>
            </li>
            <li>
                <a href="supplier.php">
                    <i class="fa-solid fa-truck-field"></i>
                    <span>Supplier</span>
                </a>
            </li>
            <li>
                <a href="transaction.php">
                    <i class="fa-solid fa-indian-rupee-sign"></i>
                    <span>Transaction</span>
                </a>
            </li>
            <!-- Add more options as needed -->
        </ul>
        <footer></footer>
    </div>

    <div id="content">
        <div style="height:100px"></div>
        <div class="container1">
            <div class="box1">
            <h2><i class="fa-solid fa-users"></i></h2>
            <h2>Total Customers: <?php echo $customer_count; ?></h2>
            </div>
            <div class="box1">
            <h2><i class="fa-solid fa-user-large"></i></h2>
            <h2>Total Employees: <?php echo $employee_count; ?></h2>
            </div>
            <div class="box1">
            <h2><i class="fa-solid fa-laptop"></i></h2>
            <h2>Total Products: <?php echo $product_count; ?></h2>
            </div>
        </div>
        <div class="container1">
            <div class="box1">
            <h2><i class="fa-solid fa-users"></i></h2>
            <h2>Total Supplier: <?php echo $supplier_count; ?></h2>
            </div>

            <div class="box1">
            <h2><i class="fa-solid fa-laptop"></i></h2>
            <h2>Number of Transactions: <?php echo $transactions_count; ?></h2>
            </div>
        </div>
    </div>

</body>
</html>
