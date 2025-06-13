<?php
include 'database/config.php';
session_start();

$rid = isset($_GET['rid']) ? (int) $_GET['rid'] : 0;

$delete = $conn->prepare("DELETE FROM reviews WHERE review_id = ?");
$delete->bind_param("i", $rid);

if ($delete->execute()) {
    $_SESSION['status_message'] = "Review deleted.";
} else {
    $_SESSION['status_message'] = "Error deleting review: " . $conn->error;
}

$delete->close();
header("Location: manage-reviews");
exit();
