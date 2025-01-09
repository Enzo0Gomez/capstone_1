<?php
session_start();
require '../connect/connection.php';
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session
header("Location: ../login-system/login.php"); // Redirect to login page
exit();
?>