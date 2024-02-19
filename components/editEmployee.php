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

if(isset($_GET['emp_id'])) {
    $emp_id = $_GET['emp_id'];

    // Now you can use $cust_id to fetch the customer details for editing
    // For example:
    $sql = "SELECT * FROM employee WHERE emp_id = $emp_id";
    $result = $connection->query($sql);

    if(!$result || $result->num_rows == 0) {
        echo "Employee not found.";
        exit;
    }

    // Fetch the customer details
    $row = $result->fetch_assoc();
    $fname = $row['fname'];
    $lname = $row['lname'];
    $gender = $row['gender'];
    $email = $row['email'];
    $ph_no= $row['ph_no'];

} else {
    echo "Employee ID not provided.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $ph_no = $_POST['ph_no'];

    // Update customer details in the database
    $sql_update = "UPDATE employee SET fname='$fname', lname='$lname', gender='$gender', email='$email', ph_no='$ph_no' WHERE emp_id=$emp_id";

    if ($connection->query($sql_update) === TRUE) {
        echo "Employee details updated successfully.";
        header("location:employee.php");
         exit;
    } else {
        echo "Error updating Employee details: " . $connection->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Edit Employee</title>
</head>
<body>
    <div class="container my-5">
        <h2>Edit Employee</h2>
        <!-- Form for editing customer details -->
        <form method="post">
            <input type="hidden" name="emp_id" value="<?php echo $emp_id; ?>">
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
                <label for="gender" class="form-label">Gender</label>
                <input type="text" class="form-control" id="gender" name="gender" value="<?php echo $gender; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
            </div>
            <div class="mb-3">
                <label for="ph_no" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="ph_no" name="ph_no" value="<?php echo $ph_no; ?>">
            </div>
            <!-- Add more fields as needed -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
