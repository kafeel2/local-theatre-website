<?php
$hn = "localhost";// Database host
$un = "root";// Database username
$pw = "";// Database password

// Database name
$db = "local_theatre_db"; // Change this to your actual database name
// Create database connection
$conn = new mysqli($hn, $un, $pw, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
// else echo 'connection successful';
?>
