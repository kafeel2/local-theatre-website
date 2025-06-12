<?php
include 'database/config.php';
session_start();

$showId = $_GET['sid'];
$userId = $_GET['uid'];

$insertShow = $conn->prepare("INSERT INTO shows (show_name, show_type, date_shown, image_url) VALUES (?, ?, ?, ?)");

// Bind parameters to prevent SQL injection
$insertShow->bind_param("ssss", $_POST['show_name'], $_POST['show_type'], $_POST['date_shown'], $_POST['image_url']);

// Execute the query
if ($insertShow->execute()) {
    $_SESSION['status_message'] = "Show added successfully!";
} else {
    $_SESSION['status_message'] = "Error: " . $conn->error;
}

// Close statement
$insertShow->close();

// Redirect back to manage-shows
header("Location: manage-shows");
exit();

