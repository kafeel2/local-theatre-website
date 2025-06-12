<?php
include 'database/config.php';
session_start();

$showId = $_GET['sid'];
$userId = $_GET['uid'];

$insertReview = $conn->prepare("INSERT INTO reviews (review_text, show_id, user_id) VALUES (?, ?, ?)");

// Bind parameters to prevent SQL injection
$insertReview->bind_param("sii", $_POST['review_text'], $showId, $userId);

// Execute the query
if ($insertReview->execute()) {
    $_SESSION['status_message'] = "Review added successfully!";
} else {
    $_SESSION['status_message'] = "Error: " . $conn->error;
}

// Close statement
$insertReview->close();

// Redirect back to the shows page
header("Location: shows");
exit();



