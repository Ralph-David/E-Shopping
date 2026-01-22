<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); // Change this to your MySQL username
define('DB_PASS', 'root1234'); // Change this to your MySQL password
define('DB_NAME', 'emart');

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8
$conn->set_charset("utf8");
?>