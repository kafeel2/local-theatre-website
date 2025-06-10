<?php
$hn = "localhost";// Database host
$un = "root";// Database username
$pw = "";// Database password


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Database name
$db = "local_theatre_db"; 


// Create database connection
$conn = new mysqli($hn, $un, $pw, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
// else echo 'connection successful';
?>
