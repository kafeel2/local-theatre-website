<?php
include 'database/config.php';
session_start();

// Ensure that the cid is sanitized or validated as an integer
$cid = isset($_GET['cid']) ? (int) $_GET['cid'] : 0;

// First, delete the comment
$delete_comment = $conn->prepare("DELETE FROM comments WHERE comment_id = ?");
$delete_comment->bind_param("i", $cid);

if ($delete_comment->execute()) {
    $_SESSION['status_message'] = "Comment deleted successfully!";
} else {
    $_SESSION['status_message'] = "Error deleting comment: " . $conn->error;
}

$delete_comment->close();

// Redirect back to the comments page
header("Location: comments");
exit();
?>
