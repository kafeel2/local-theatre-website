<?php
include 'database/config.php';
$bid = isset($_GET['bid']) ? (int) $_GET['bid'] : 0;

echo $_POST['blog_title'];
echo $_POST['blog_content'];

$blogs = $conn->prepare("UPDATE blogs
    SET blog_title = ?, blog_content = ?
    WHERE blog_id = ?");
  

$blogs->bind_param("ssi", $_POST['blog_title'], $_POST['blog_content'], $bid);
$blogs->execute();
if ($blogs->affected_rows > 0) {
    $_SESSION['success'] = "Blog updated successfully.";
} else {
    $_SESSION['error'] = "Failed to update blog. Please try again.";
}
header("Location: manage-blogs");
// 