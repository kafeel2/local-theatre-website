<?php
include 'database/config.php';
session_start();

// Optional: Restrict access to admin only
// if ($_SESSION['role'] !== 'admin') {
//     header("Location: login.php");
//     exit();
// }

// Sanitize and validate the comment ID
$cid = isset($_GET['cid']) ? (int) $_GET['cid'] : 0;

// Prepare the statement
$reject = $conn->prepare("UPDATE comments SET status = 'rejected' WHERE comment_id = ?");
$reject->bind_param("i", $cid);

// Execute the query
if ($reject->execute()) {
    $_SESSION['status_message'] = "Comment rejected successfully!";
} else {
    $_SESSION['status_message'] = "Error: " . $conn->error;
}

$reject->close();

// Redirect back to comments page
header("Location: comments.php");
exit();
?>
