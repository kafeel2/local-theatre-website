<?php
include 'database/config.php';
$uid = isset($_GET['uid']) ? (int) $_GET['uid'] : 0;

echo $_POST['username'];
echo $_POST['email'];
echo $_POST['role'];

$update = $conn->prepare("UPDATE users
    SET username = ?, email = ?, role = ?
    WHERE user_id = ?");

$update->bind_param("sssi", $_POST['username'], $_POST['email'], $_POST['role'], $uid);
$update->execute();

if ($update->affected_rows > 0) {
    $_SESSION['success'] = "User updated successfully.";
} else {
    $_SESSION['error'] = "Failed to update user. Please try again.";
}

header("Location: dashboard");

