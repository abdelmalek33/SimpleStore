<?php
include'security_url.php'; 
include'connect.php';

if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];

    $sql="delete from users where id=$id";
    $result = mysqli_query($conn,$sql);
    if($result){
        header('location:users.php');
    }else{
        die(mysqli_error($conn));
    }

}
?>