<?php
$servername = "localhost";
$username = "root";
$password ="";
$database = "computersales";

$connection = new mysqli($servername, $username, $password, $database);

$fname ="";
$lname ="";
$ph_no ="";
$location ="";
$emp_id ="";

$errorMessage = "";
$successMessage = "";

// Fetching employee IDs from the employee table
$employeeIds = [];
$sqlEmployee = "SELECT emp_id FROM employee";
$resultEmployee = $connection->query($sqlEmployee);
if ($resultEmployee->num_rows > 0) {
    while ($row = $resultEmployee->fetch_assoc()) {
        $employeeIds[] = $row['emp_id'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $ph_no = $_POST["ph_no"];
    $location = $_POST["location"];
    $emp_id = $_POST["emp_id"];

    do {
        if (empty($fname) || empty($lname) || empty($ph_no) || empty($location) || empty($emp_id)) {
            $errorMessage = "All the fields are required";
            break;
        }

        // Add customer to db
        $sql = "INSERT INTO customers(fname, lname, ph_no, location, emp_id)" .
        "VALUES('$fname','$lname','$ph_no','$location','$emp_id')";
        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid query" . $connection->error;
            break;
        }

        $successMessage = "Customer added Correctly";
        header("location:customers.php");
        exit;

    } while(false);
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
        <h2>New customer</h2>
        <?php
        if(!empty($errorMessage)){
            echo "
            <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
        ?>
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">First Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="fname" value="<?php echo $fname; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Last Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="lname" value="<?php echo $lname; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="ph_no" value="<?php echo $ph_no; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Location</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="location" value="<?php echo $location; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Employee ID</label>
                <div class="col-sm-6">
                    <select class="form-select" name="emp_id">
                        <option value="">Select Employee ID</option>
                        <?php foreach ($employeeIds as $employeeId) : ?>
                            <option value="<?php echo $employeeId; ?>"><?php echo $employeeId; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <?php
            if(!empty($successMessage)){
                echo"
                <div class = 'row mb-3'>
                <div class ='offset-sm-3 col-sm-6'>
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                </div>
                </div>
                </div>";
            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="customers.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
