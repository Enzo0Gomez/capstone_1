<?php 

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "capstone_maternal";

$connect = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);

/*
// Check connection
if ($mysqli -> connect_error) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}*/

try {
  $pdo = new PDO("mysql:host=localhost;dbname=capstone_maternal", "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}
?>