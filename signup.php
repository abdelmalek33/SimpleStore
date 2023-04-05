<?php
include'connect.php';
include'insert_user.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap-5.3.0-alpha1-dist/css/bootstrap.css">
    <title>Signup page</title>
</head>
<body class="text-bg-light">

<div class="container text-bg-info p-5 rounded position-relative mt-5 w-50 fw-semibold" >
    <h1 class="text-center fw-bold ">Sign up</h1>
    <form action="signup.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="user_name" class="form-label">Username</label>
            <input autocomplete="off" required name="user_name" type="text" class="form-control" id="user_name" aria-describedby="emailHelp">
        </div>  
        <div class="mb-3">
            <label for="user_pass" class="form-label">Password</label>
            <input autocomplete="off" required name="user_pass" type="password" class="form-control" id="user_pass">
        </div>
        <div class="mb-3">
            <label for="user_email" class="form-label">Email</label>
            <input autocomplete="off" required name="user_email" type="email" class="form-control" id="user_email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input required class="form-control" name="user_image" type="file" id="image">
        </div>
        <div class="mb-3 form-radio " >
            <input name="user_role" value="customer" type="radio" class="form-check-input" id="Check1" checked>
            <label class="form-check-label" for="Check3">Customer</label> 
            
            <input name="user_role" value="supplier"type="radio" class="form-check-input" id="Check2" >
            <label class="form-check-label" for="Check2">Supplier</label>
            
            <input name="user_role" value="admin" type="radio" class="form-check-input" id="Check3" >
            <label class="form-check-label" for="Check3">Admin</label> 
            
        </div> 
        <button name="submit" type="submit" class="px-4 py-2  btn btn-primary">Send</button>
        <button name="login" class="btn btn-success"><a class="px-2 py-2 text-decoration-none text-light" href="login.php">Login</a></button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.js"></script>
</body>
</html>