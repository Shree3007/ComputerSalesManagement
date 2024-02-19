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

if(isset($_GET['cust_id'])) {
    $cust_id = $_GET['cust_id'];

    // Now you can use $cust_id to fetch the customer details for editing
    // For example:
    $sql = "SELECT * FROM customers WHERE cust_id = $cust_id";
    $result = $connection->query($sql);

    if(!$result || $result->num_rows == 0) {
        echo "Customer not found.";
        exit;
    }

    // Fetch the customer details
    $row = $result->fetch_assoc();
    $fname = $row['fname'];
    $lname = $row['lname'];
    $ph_no = $row['ph_no'];
    $location = $row['location'];
    $emp_id = $row['emp_id'];

} else {
    echo "Customer ID not provided.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $ph_no = $_POST['ph_no'];
    $location = $_POST['location'];
    $emp_id = $_POST['emp_id'];

    // Update customer details in the database
    $sql_update = "UPDATE customers SET fname='$fname', lname='$lname', ph_no='$ph_no', location='$location', emp_id='$emp_id' WHERE cust_id=$cust_id";

    if ($connection->query($sql_update) === TRUE) {
        echo "Customer details updated successfully.";
        header("location:customers.php");
         exit;
    } else {
        echo "Error updating customer details: " . $connection->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Edit Customer</title>
</head>
<body>
    <div class="container my-5">
        <h2>Edit Customer</h2>
        <!-- Form for editing customer details -->
        <form method="post">
            <input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
            <!-- Add form fields for editing customer details here -->
            <div class="mb-3">
                <label for="fname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $fname; ?>">
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $lname; ?>">
            </div>
            <div class="mb-3">
                <label for="ph_no" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="ph_no" name="ph_no" value="<?php echo $ph_no; ?>">
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="<?php echo $location; ?>">
            </div>
            <div class="mb-3">
                <label for="emp_id" class="form-label">Employee ID</label>
                <input type="text" class="form-control" id="emp_id" name="emp_id" value="<?php echo $emp_id; ?>">
            </div>
            <!-- Add more fields as needed -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
