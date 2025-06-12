<?php
include 'database/config.php';
session_start();

$rid = isset($_GET['rid']) ? (int) $_GET['rid'] : 0;

$reject = $conn->prepare("UPDATE reviews SET status = 'rejected' WHERE review_id = ?");
$reject->bind_param("i", $rid);

if ($reject->execute()) {
    $_SESSION['status_message'] = "Review rejected.";
} else {
    $_SESSION['status_message'] = "Error: " . $conn->error;
}

$reject->close();
header("Location: reviews");
exit();
