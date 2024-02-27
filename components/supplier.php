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

$sql = "SELECT * FROM supplier";
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
    <title>List of Supplier</title>
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
    <div class="container my-5">
        <h2>List of Suppliers</h2>
        <a class="btn btn-primary" href="createSupplier.php" role="button">New Supplier</a>
        <br><br>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>SUP_ID</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Company Name</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row = $result->fetch_assoc()){
                    $sup_id = $row['sup_id'];
                    $name = $row['name'];
                    $location = $row['location'];
                    $company_name = $row['company_name'];
                    $ph_no = $row['ph_no'];
                    echo '
                    <tr>
                        <td>'.$sup_id.'</td>
                        <td>'.$name.'</td>
                        <td>'.$location.'</td>
                        <td>'.$company_name.'</td>
                        <td>'.$ph_no.'</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="editSupplier.php?sup_id='.$sup_id.'" role="button">Edit</a>
                            <a class="btn btn-danger btn-sm" href="deleteSupplier.php?sup_id='.$sup_id.'" role="button">Delete</a>
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
