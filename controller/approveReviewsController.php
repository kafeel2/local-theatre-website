<?php
include 'database/config.php';
session_start();

$rid = isset($_GET['rid']) ? (int) $_GET['rid'] : 0;

$approve = $conn->prepare("UPDATE reviews SET status = 'approved' WHERE review_id = ?");
$approve->bind_param("i", $rid);

if ($approve->execute()) {
    $_SESSION['status_message'] = "Review approved.";
} else {
    $_SESSION['status_message'] = "Error: " . $conn->error;
}

$approve->close();
header("Location: manage-reviews");
exit();
