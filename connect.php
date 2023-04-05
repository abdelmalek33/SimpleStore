<?php 
$conn =new mysqli('localhost','root','','luca_store');
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>