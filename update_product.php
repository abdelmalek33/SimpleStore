<?php
include'security_url.php';
include'connect.php';

$id=$_GET['updateid'];
$sql ="select * from productions where id='$id'"; 
$result=mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

$productname=$row['product_name'];
$productprice=$row['product_price'];
$productdescription=$row['product_description'];

if(isset($_POST['submit']))
{
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description']; 

    // Move the uploaded file to the "photos" directory
    // Get the uploaded file data using the $_FILES superglobal
    $photo_tmp_name = $_FILES['product_photo']['tmp_name'];
    $photo_name = $_FILES['product_photo']['name'];
    $photo_path = "images_productions/".$photo_name;

    $sql= "update productions set product_name=?,product_price=?,product_description=?,product_photo=? where id='$id'"; 
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdss", $product_name, $product_price, $product_description, $photo_path);
    move_uploaded_file($photo_tmp_name, $photo_path);
    
    $result= $stmt->execute(); 

    if ($result) {
        header('location:productions.php');
    }else{
        die(mysqli_error($conn));
    }
} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Product</title>
    <link rel="stylesheet" href="bootstrap-5.3.0-alpha1-dist/css/bootstrap.css">
    <style>
    container {
        height: 100vh;
    }

    label {
        display: block;
        margin-bottom: 5px;
        letter-spacing: 1.5px;
        font-size: 12px;
        font-weight: bold;
    }
    </style>
</head>

<body class="bg-info">
    <div style="margin-top:10px;border-radius:6px;max-width:500px" class=" py-2 bg-light container">
        <div class="head_product">
            <h1 class=" text-center">Add Product</h1>
            <img style="border-radius:3px;width:100%;max-height:150px;" src="add_product.png" alt="logo">
        </div>

        <form autocomplete="off" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label id="label_product_name" for="product_name">Name:</label>
                <input value="<?php echo $productname?>" required id="product_name" name="product_name" type="text" class="form-control" />
            </div>
            <div class="mb-3">
                <label id="price_label" for="price">Price:</label>
                <input value="<?php echo $productprice?>" required id="price" min="0" step="0.25" name="product_price" type="number"
                    class="form-control" />
            </div>
            <div class="mb-3">
                <label id="description_label" for="product_description">Description:</label>
                <input class="form-control" type="text" value="<?php echo $productdescription?>" required id="product_description" name="product_description" required></input> 
            </div>
            <div class="mb-3">
                <label id="photo_label" for="product_photo">Photo:</label>
                <input type="file" id="product_photo" name="product_photo" required>
            </div>
            <button name="submit" type="submit" class=" fw-bold px-4 py-2  btn btn-success">Update</button>
            <button name="reset" type="reset" class=" fw-bold px-4 py-2  btn btn-danger">Reset</button>
            <a class="btn btn-warning text-light fw-bold"href="productions.php">All Products</a>
        </form>
    </div>
    <script src="/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.js"></script>
</body>

</html>