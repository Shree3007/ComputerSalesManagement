<?php
// Database connection parameters
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

// Query to fetch the latest 5 transactions
$sql = "SELECT * FROM transactions ORDER BY date DESC LIMIT 5";
$result = $connection->query($sql);

// Close connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latest Transactions</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <h1>Latest Transactions :</h1>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Product ID</th>
                <th>Customer ID</th>
                <th>Date</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if there are any transactions
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["tr_id"] . "</td>";
                    echo "<td>" . $row["p_id"] . "</td>";
                    echo "<td>" . $row["cust_id"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td>" . $row["price"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No transactions found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
