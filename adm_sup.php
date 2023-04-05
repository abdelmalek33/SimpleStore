<?php
if ($_SESSION['user_role'] !== 'admin' && $_SESSION['user_role'] !== 'supplier') {
    
  header('Location: productions.php');
  exit();
}
?>