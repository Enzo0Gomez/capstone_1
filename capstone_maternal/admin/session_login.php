<?php

session_start();
include('../connect/connection.php');
// Check if the user is logged in and is an admin
if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== 'Admin') {
    // Redirect to login page if not logged in or not an admin
    header("Location: ../login-system/login.php");
    exit();
}

?>