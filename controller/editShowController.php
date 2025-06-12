<?php
include 'database/config.php';
$sid = isset($_GET['sid']) ? (int) $_GET['sid'] : 0;

echo $_POST['show_name'];
echo $_POST['show_type'];

$shows = $conn->prepare("UPDATE shows
    SET show_name = ?, show_type = ?
    WHERE show_id = ?");
  
$shows->bind_param("ssi", $_POST['show_name'], $_POST['show_type'], $sid);
$shows->execute();

if ($shows->affected_rows > 0) {
    $_SESSION['success'] = "Show updated successfully.";
} else {
    $_SESSION['error'] = "Failed to update show. Please try again.";
}

header("Location: manage-shows");
