<?php 
include'security_url.php';
include'adm_sup.php';
include'connect.php';
include'insert_product.php';
?>

<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>Products</title><link rel="stylesheet" href="bootstrap-5.3.0-alpha1-dist/css/bootstrap.css"><style>container{height: 100vh;}label{display:block;margin-bottom:5px;letter-spacing:1.5px;font-size:12px;font-weight:bold;}</style></head>

<body class="bg-info">
    <div style="margin-top:10px;border-radius:6px;max-width:500px"class=" py-2 bg-light container">
        <div class="head_product">
            <h1 class=" text-center">Add Product</h1>
            <img style="border-radius:3px;width:100%;max-height:150px;" src="add_product.png" alt="logo">
        </div>
        
        <form autocomplete="off" action="add_product.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label id="label_product_name" for="product_name">Name:</label>
                <input required id="product_name" name="product_name" type="text" class="form-control" />
            </div>               
            <div class="mb-3">
                <label id="price_label" for="price">Price:</label>
                <input required id="price" min="0" step="0.50" name="product_price" type="number" class="form-control" />
            </div>
            <div class="mb-3">
                <label id="description_label" for="product_description">Description:</label>
                <textarea required id="product_description" name="product_description" required></textarea>
            </div>
            <div class="mb-3">
                <label id="photo_label" for="product_photo">Photo:</label>
                <input type="file" id="product_photo" name="product_photo" required>
            </div>
            <button name="submit" type="submit" class=" fw-bold px-4 py-2  btn btn-success">Send</button>
            <button name="reset" type="reset" class=" fw-bold px-4 py-2  btn btn-danger">Reset</button>
            <a class="btn btn-warning text-light fw-bold"href="productions.php">All Products</a>
        </form>
    </div>
    <script src="/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.js"></script>
</body>
</html>