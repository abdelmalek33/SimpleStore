<?php 
include'security_url.php';
include'connect.php';
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap-5.3.0-alpha1-dist/css/bootstrap.css">
    <title>Productions</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .form>div {
        width: calc(100%/3); 
        border: 2px solid #fff;
        border-radius: 6px;
    } 
    </style>
</head> 
<body style="height:100vh;display:flex;flex-direction:column;justify-content:space-between;"> 
<nav class="navbar bg-dark py-1">
    <div class="container-fluid">
        <a class="fs-2 text-light navbar-brand" href="#">SwiftStore</a> 
            <ul class="nav ms-auto">
                <?php if ($_SESSION['user_role'] === 'admin'){
                    echo "
                    <li class='nav-item'>
                    <a class='nav-link text-light'href='users.php'>Users</a>
                    </li>
                    ";
                }
                ?> 
                <li class="nav-item">
                    <a class=" nav-link text-light" href="productions.php">Productions</a>
                </li>
                <?php if ($_SESSION['user_role'] === 'admin' || $_SESSION['user_role'] === 'supplier'){
                    echo "
                    <li class='nav-item'>
                        <a class='nav-link text-light'href='add_product.php'>Add Product</a>
                    </li>
                    ";
                }
                ?> 
                <li class="nav-item">
                    <form action="logout.php" method="post"><button type="submit" name="logout" class="btn btn-danger">Logout</button></form>
                </li>
            </ul> 
    </div>
</nav>
<div class="content">
    <?php 
    $sql="select * from productions";
    $result = $conn->query($sql);

    if($result->num_rows > 0 ){ 
        echo"
        <div class=\"main\">
            <h1 class=\" fw-bold text-center\">Productions</h1>
            <div class=\"bg-info form d-flex flex-wrap\">
            ";
        while($row = $result->fetch_assoc()){
            $id=$row['id'];
            $product_name=$row['product_name'];
            $product_price=$row['product_price'];
            $product_description=$row['product_description'];
            $product_photo=$row['product_photo'];
            echo"<div class=\"text-center items\">";
                echo"<img src='" . $row["product_photo"] . "' alt='" . $row["product_name"] . "' width='100%' height='200'>";
                echo "<h2>" . $row["product_name"] . "</h2>";
                echo "<p>Price: " . $row["product_price"] . "$</p>";
                echo "Description:<p style='width:100%; word-wrap:break-word;'>" . $row["product_description"] . "</p>";
                if ($_SESSION['user_role'] === 'admin' || $_SESSION['user_role'] === 'supplier'){
                    echo"
                    <div class='btn_edit mb-1'>
                    <a href='update_product.php? updateid=$id' class='btn btn-success'>UPDATE</a>
                    <a href='delete_product.php? deleteid=$id' class='btn btn-danger'>DELETE</a>
                    </div>
                    ";
                }
            echo"</div>"; 
        }
        echo"</div></div>";
    }else{
        echo "<pre><b class=' text-danger fs-3'>  No products found.<b></pre>";
    } 
    $conn->close();
    ?> 
</div>
<footer class="text-center bg-dark text-light py-1">
    <div class="container">
        <p class="mb-0 fs-6">Copyright &copy; <?php echo date("Y"); ?> SwiftStore . All rights reserved.</p>
    </div>
</footer>
</body> 
</html> 