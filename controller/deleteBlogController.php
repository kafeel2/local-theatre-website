<?php
include 'database/config.php';
session_start();

// Ensure that the cid is sanitized or validated as an integer
$bid = isset($_GET['bid']) ? (int) $_GET['bid'] : 0;

$delete_comment = $conn->prepare("DELETE from comments WHERE blog_id = ?"); 
    
    
// Bind the parameter (i = integer)
$delete_comment->bind_param("i", $bid);

// Execute the query
if ($delete_comment->execute()) {
    $_SESSION['status_message'] = "Blog comments deleted successfully!";
} else {
    $_SESSION['status_message'] = "Error: " . $conn->error;
}

// Close the statement
$delete_comment->close();





    // Prepare the statement with a placeholder
    $delete = $conn->prepare("DELETE from blogs WHERE blog_id = ?"); 
    
    
    // Bind the parameter (i = integer)
    $delete->bind_param("i", $bid);
    
    // Execute the query
    if ($delete->execute()) {
        $_SESSION['status_message'] = "Blog post deleted successfully!!";
    } else {
        $_SESSION['status_message'] = "Error: " . $conn->error;
    }
    
    // Close the statement
    $delete->close();


// Redirect back to the comments page
header("Location: manage-blogs");
exit();
?>