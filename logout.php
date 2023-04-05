<?php
include'security_url.php'; 
if (isset($_POST['logout'])) {
    // unset the session variables
    session_unset();
    // destroy the session
    session_destroy();
    // redirect to the welcome page
    header("location: welcome.php");
    exit();
}  
?>