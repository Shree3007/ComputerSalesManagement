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

$sql = "SELECT * FROM product";
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
    <title>List of Products</title>
</head>
<body>
<div id="sidebar"><li>
        <header><a href="home.html">
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
                <a href="tasks.html">
                    <i class="fa-solid fa-laptop"></i>
                    <span>Product</span>
                </a>
            </li>
            <li>
                <a href="profile.html">
                    <i class="fa-solid fa-truck-field"></i>
                    <span>Supplier</span>
                </a>
            </li>
            <li>
                <a href="profile.html">
                    <i class="fa-solid fa-indian-rupee-sign"></i>
                    <span>Transaction</span>
                </a>
            </li>
            <!-- Add more options as needed -->
        </ul>
        <footer></footer>
    </div>
    <div id="content">
    <div class="container my-5">
        <h2>List of Products</h2>
        <a class="btn btn-primary" href="createProduct.php" role="button">New Product</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>P_ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Supplier_ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row = $result->fetch_assoc()){
                    $p_id = $row['p_id'];
                    $name = $row['name'];
                    $category = $row['category'];
                    $description = $row['description'];
                    $stock = $row['stock'];
                    $price = $row['price'];
                    $sup_id = $row['sup_id'];
                    echo '
                    <tr>
                        <td>'.$p_id.'</td>
                        <td>'.$name.'</td>
                        <td>'.$category.'</td>
                        <td>'.$description.'</td>
                        <td>'.$stock.'</td>
                        <td>'.$price.'</td>
                        <td>'.$sup_id.'</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="editProduct.php?p_id='.$p_id.'" role="button">Edit</a>
                            <a class="btn btn-danger btn-sm" href="deleteProduct.php?p_id='.$p_id.'" role="button">Delete</a>
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
