<?php
$servername = "localhost";
$username = "root";
$password ="";
$database = "computersales";


$connection = new mysqli($servername, $username, $password, $database);



$name ="";
$category ="";
$description ="";
$stock ="";
$price ="";
$sup_id ="";


$errorMessage = "";
$successMessage = "";


if( $_SERVER['REQUEST_METHOD']== 'POST'){
    $name =$_POST["name"];
    $category =$_POST["category"];
    $description =$_POST["description"];
    $stock =$_POST["stock"];
    $price =$_POST["price"];
    $sup_id =$_POST["sup_id"];

    do{
        if(empty($name) || empty($category) || empty($description) || empty($stock) || empty($price) || empty($sup_id)){
            $errorMessage = "All the fields are required";
            break;
        }

        //add client to db
        $sql = "INSERT INTO product(name,category,description,stock,price,sup_id)" .
        "VALUES('$name','$category','$description','$stock','$price','$sup_id')";
        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid query" . $connection->error;
            break;
        }

       

        $successMessage = "product added Correctly";
        header("location:product.php");
        exit;

    }while(false);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5"> 
        <h2>New product</h2>


        <?php
        if(!empty($errorMessage)){
            echo"
            <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        
        ?>
        <form method="post">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Category</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="category" value="<?php echo $category; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Description</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="description" value="<?php echo $description; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Stock</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="stock" value="<?php echo $stock; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Price</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="price" value="<?php echo $price; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Sup_ID</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="sup_id" value="<?php echo $sup_id; ?>">
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
            </div>
            ";
        }

        ?>

        
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="product.php" role="button">Cancel</a>
            </div>
        </div>

        </form>
    </div>
</body>
</html>