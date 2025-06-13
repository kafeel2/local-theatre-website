<?php
include '../database/config.php';
session_start();

$rid = isset($_GET['rid']) ? (int) $_GET['rid'] : 0;
$reviewText = $_POST['review_text'] ?? '';

// Prevent updating if text is empty
if (empty($reviewText)) {
    $_SESSION['status_message'] = "Review cannot be empty!";
    header("Location: edit-review?rid=$rid");
    exit();
}

$update = $conn->prepare("UPDATE reviews SET review_text = ? WHERE review_id = ?");
$update->bind_param("si", $reviewText, $rid);

if ($update->execute()) {
    $_SESSION['status_message'] = "Review updated successfully!";
} else {
    $_SESSION['status_message'] = "Error: " . $conn->error;
}

$update->close();
header("Location: admin/manage-reviews");
exit();
