<?php
include 'database/config.php';
session_start();

// Ensure that the sid is sanitized or validated as an integer
$sid = isset($_GET['sid']) ? (int) $_GET['sid'] : 0;

// Delete the show
$delete_show = $conn->prepare("DELETE FROM shows WHERE show_id = ?");
$delete_show->bind_param("i", $sid);

if ($delete_show->execute()) {
    $_SESSION['status_message'] = "Show deleted successfully!";
} else {
    $_SESSION['status_message'] = "Error deleting show: " . $conn->error;
}

$delete_show->close();

// Redirect back to manage-shows
header("Location: manage-shows");
exit();
?>
