<?php
// customers.php

$servername = "localhost";
$username = "root";
$password ="";
$database = "computersales";

$connection = new mysqli($servername, $username, $password, $database);

if($connection->connect_error){
    die("Connection Failed: " . $connection->connect_error);
}

$sql = "SELECT * FROM transactions";
$result = $connection->query($sql);

$sql = "SELECT t.tr_id, t.p_id, t.cust_id, t.date, t.quantity, t.price, c.fname, p.name
        FROM transactions t
        INNER JOIN customers c ON t.cust_id = c.cust_id
        INNER JOIN product p ON t.p_id = p.p_id";
$result = $connection->query($sql);

if(!$result){
    die("Invalid query: " . $connection->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/Hstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>List of transactions</title>
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
        <footer>
        <li>
                <a href="../index.html">
                <i class="fa-solid fa-right-from-bracket"></i>
                    <span>log Out</span>
                </a>
            </li>
        </footer>
    </div>
    <div id="content">
    <div class="container my-5">
        <h2>List of transactions</h2>
        <a class="btn btn-primary" href="createTransaction.php" role="button">New Transaction</a>
        <br><br>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Transaction_ID</th>
                    <th>Product_ID</th>
                    <th>Customer ID</th>
                    <th>Date</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row = $result->fetch_assoc()){
                    $tr_id = $row['tr_id'];
                    $p_id = $row['p_id'];
                    $cust_id = $row['cust_id'];
                    $date = $row['date'];
                    $quantity = $row['quantity'];
                    $price = $row['price'];
                    echo '
                    <tr>
                        <td>'.$tr_id.'</td>
                        <td>'.$p_id.'</td>
                        <td>'.$cust_id.'</td>
                        <td>'.$date.'</td>
                        <td>'.$quantity.'</td>
                        <td>'.$price.'</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="editTransaction.php?tr_id='.$tr_id.'" role="button">Edit</a>
                            <a class="btn btn-danger btn-sm" href="deleteTransaction.php?tr_id='.$tr_id.'" role="button">Delete</a>
                        </td>
                    </tr>
                    ';
                }
                ?>
            </tbody>
        </table>
    </div>
    </div>
</body>
</html>
