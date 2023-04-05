<?php
if ($_SESSION['user_role'] !== 'admin'){
  header('Location: productions.php');
  exit();
} 
?>