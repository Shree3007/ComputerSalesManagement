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

if(isset($_GET['sup_id'])) {
    $sup_id = $_GET['sup_id'];

    // Now you can use $cust_id to fetch the customer details for editing
    // For example:
    $sql = "SELECT * FROM supplier WHERE sup_id = $sup_id";
    $result = $connection->query($sql);

    if(!$result || $result->num_rows == 0) {
        echo "Customer not found.";
        exit;
    }

    // Fetch the customer details
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $location = $row['location'];
    $company_name = $row['company_name'];
    $ph_no = $row['ph_no'];

} else {
    echo "Supplier ID not provided.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $company_name = $_POST['company_name'];
    $ph_no = $_POST['ph_no'];


    // Update customer details in the database
    $sql_update = "UPDATE supplier SET name='$name', location='$location', company_name='$company_name', ph_no='$ph_no' WHERE sup_id=$sup_id";

    if ($connection->query($sql_update) === TRUE) {
        echo "Supplier details updated successfully.";
        header("location:supplier.php");
         exit;
    } else {
        echo "Error updating Supplier details: " . $connection->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/Hstyle.css">
    <title>Edit Supplier</title>
</head>
<body class="body">
    <div class="container my-5">
        <h2>Edit Supplier</h2>
        <!-- Form for editing customer details -->
        <form method="post">
            <input type="hidden" name="sup_id" value="<?php echo $sup_id; ?>">
            <!-- Add form fields for editing customer details here -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="<?php echo $location; ?>">
            </div>
            <div class="mb-3">
                <label for="ph_no" class="form-label">Company Name</label>
                <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo $company_name; ?>">
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="ph_no" name="ph_no" value="<?php echo $ph_no; ?>">
            </div>

            <!-- Add more fields as needed -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
