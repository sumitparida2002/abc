<?php
$servername = "localhost";
$username = "root";
$password = "kyGRU0717";
$database = "abc";
$dsn = "mysql:host=localhost;dbname=abc;port=3306;charset=utf8";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
$myPDO = new PDO($dsn, $username, $password);
?>