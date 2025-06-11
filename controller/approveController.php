<?php
include 'database/config.php';
session_start();

// Validate and sanitise comment ID
$cid = isset($_GET['cid']) ? (int) $_GET['cid'] : 0;

$approve = $conn->prepare("UPDATE comments SET status = 'approved' WHERE comment_id = ?");
$approve->bind_param("i", $cid);

if ($approve->execute()) {
    $_SESSION['status_message'] = "Approved successfully!";
} else {
    $_SESSION['status_message'] = "Error: " . $conn->error;
}

$approve->close();

// Redirect to the comments page in /admin
header("Location: comments.php");
exit();
?>
