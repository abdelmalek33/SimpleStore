<?php
// start the session
session_start();

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    // If user is not logged in, redirect to login page
    header("location: login.php");
    exit();
}
?>