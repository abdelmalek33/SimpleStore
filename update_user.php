<?php
include'security_url.php'; 
include'connect.php';

    $id=$_GET['updateid'];
    $sql ="select * from users where id='$id'";
    $result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);


    $userid=$row['id'];
    $username=$row['user_name'];
    $userpass='??????';
    $useremail=$row['user_email'];
    $userrole=$row['user_role'];

if(isset($_POST['submit'])){

    $user_name=$_POST['user_name'];
    $user_email=$_POST['user_email'];
    $user_role=$_POST['user_role'];
    
    $user_image=$_FILES['user_image'];
    $image_location=$_FILES['user_image']['tmp_name'];
    $image_name = $_FILES['user_image']['name'];
    $image_up="images_users/".$image_name;
    
    $user_pass=$_POST['user_pass'];
    // Hash password
    $user_pass = hash('sha256', $user_pass);

    $sql="update users set user_name=?,user_pass=?,user_email=?,user_role=?,user_image=? where id='$id'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss",$user_name,$user_pass,$user_email,$user_role,$image_up);
    $result= $stmt->execute();

    move_uploaded_file($image_location,$image_up);

    if ($result) {
        header('location:users.php');
    }else{
        die(mysqli_error($conn));
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap-5.3.0-alpha1-dist/css/bootstrap.css">
    <title>Update page</title>
</head>
<body class="text-bg-light">

<div class="container text-bg-info p-4 rounded position-relative mt-4 w-50 fw-semibold" >
    <h1 class="text-center fw-bold ">Update</h1>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3" style="pointer-events: none;">
            <label for="us_id" class="form-label">ID</label>
            <input value="<?php echo $userid?>" readonly autocomplete="off" required name="us_id" type="text" class="form-control" id="us_id" aria-describedby="emailHelp">
        </div> 
        <div class="mb-3">
            <label for="user_name" class="form-label">Username</label>
            <input value="<?php echo $username?>" autocomplete="off" required name="user_name" type="text" class="form-control" id="user_name" aria-describedby="emailHelp">
        </div>  
        <div class="mb-3">
            <label for="user_pass" class="form-label">Password</label>
            <input value="<?php echo $userpass?>" autocomplete="off" required name="user_pass" type="password" class="form-control" id="user_pass">
        </div>
        <div class="mb-3">
            <label for="user_email" class="form-label">Email</label>
            <input value="<?php echo $useremail?>" autocomplete="off" required name="user_email" type="email" class="form-control" id="user_email" aria-describedby="emailHelp">
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
        <button name="submit" type="submit" class="px-3 py-2  btn btn-primary">Update</button>
        <a class='btn btn-success px-3 py-2'href='users.php'>Users</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.js"></script>
</body>
</html>