<?php

$blogs = $conn->prepare("UPDATE blogs
    SET blog_title = ?, blog_content = ?
    WHERE blog_id = ?");
   ");

$blogs->bind_param("ssi", $blogTitle, $blogContent, $bid);
$blogs->execute();
if ($blogs->affected_rows > 0) {
    $_SESSION['success'] = "Blog updated successfully.";
} else {
    $_SESSION['error'] = "Failed to update blog. Please try again.";
}
header("Location: " . ROOT_DIR . "admin/manage-blogs");
