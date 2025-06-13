<?php
// Get the requested URL from the 'url' query parameter
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';

ini_set('display_errors', 1);
error_reporting(E_ALL);


// Define available routes (URL => corresponding PHP file)
$routes = [
    '' => 'pages/home.php',          // Home route
    'home' => 'pages/home.php',      // Home page route
    'contact' => 'pages/contact.php', // Contact page route
    'about' => 'pages/about.php',     // About page route
    'register' => 'pages/register.php', // Register page route
    'login' => 'pages/login.php',     // Login page route
    'blog' => 'pages/blog.php',          // Blog page route
    'blog-info' => 'pages/blog-info.php', // Blog info page route
    'reviews' => 'pages/reviews.php',      // Reviews page route
    'shows' => 'pages/shows.php',          // Shows page route
    'shows-info' => 'pages/shows-info.php', // Shows info page route


    // admin dashboard routes
    'admin/dashboard' => 'pages/admin/dashboard.php', // Admin dashboard route
    'user/dashboard' => 'pages/user/dashboard.php', // User dashboard route
    'admin/comments' => 'pages/admin/comments.php', // Admin comments route
    'admin/manage-blogs' => 'pages/admin/manage-blogs.php', // Admin manage blogs route
    'admin/edit-blog' => 'pages/admin/edit-blog.php', // Admin edit blog route
    'admin/delete-blog' => 'pages/admin/delete-blog.php', // Admin delete blog route
    'admin/edit-user' => 'pages/admin/edit-user.php', // Admin edit user route
    'admin/delete-user' => 'pages/admin/delete-user.php', // Admin delete user route
    'admin/manage-reviews' => 'pages/admin/manage-reviews.php', // Admin reviews route
    'admin/edit-review' => 'pages/admin/edit-review.php', // Admin edit review route
    'admin/manage-shows' => 'pages/admin/manage-shows.php', // Admin manage shows route
    'admin/edit-show' => 'pages/admin/edit-show.php', // Admin edit show route
    'admin/delete-show' => 'pages/admin/delete-show.php', // Admin delete show route
    'admin/add-show' => 'pages/admin/add-show.php', // Admin add show route





    // // configuration
    'registerController' => 'controller/registerController.php', // Register controller
    'loginController' => 'controller/loginController.php',     // Login controller
    'logout' => 'controller/logoutController.php',             // Logout controller
    'commentsController' => 'controller/commentsController.php', // Comments controller
    'admin/editBlogController' => 'controller/editBlogController.php', // edit blog controller
    'admin/deleteBlogController' => 'controller/deleteBlogController.php', // delete blog controller
    'admin/approveController' => 'controller/approveController.php', // Approve comment controller
    'admin/rejectController' => 'controller/rejectController.php', // Reject comment controller
    'admin/deleteCommentController' => 'controller/deleteCommentController.php', // Delete comment controller
    'admin/editUserController' => 'controller/editUserController.php', // Edit user controller
    'admin/deleteUserController' => 'controller/deleteUserController.php', // Delete user controller
    'admin/approveReviewController' => 'controller/approveReviewsController.php', // Approve review controller
    'reviewsController' => 'controller/reviewsController.php', // Reviews controller
    'admin/rejectReviewController' => 'controller/rejectReviewController.php', // Reject review controller
    'admin/deleteReviewController' => 'controller/deleteReviewController.php', // Delete review controller
    'admin/editShowController' => 'controller/editShowController.php', // Edit show controller
    'admin/deleteShowController' => 'controller/deleteShowController.php', // Delete show controller
    'admin/addShowController' => 'controller/addShowController.php', // Add show controller
    'admin/editReviewController' => 'controller/editReviewController.php', // Edit review controller
    'admin/deleteReviewController' => 'controller/deleteReviewController.php', // Delete review controller

    
    



    // 'home' => 'pages/home.php', 
    // 'contact' => 'pages/contact.php',          // contact route
    // 'about' => 'pages/about.php',
    // 'register' => 'pages/register.php',    // register page route
    // 'login' => 'pages/login.php', // login page route
    // 'blog' => 'pages/blog.php', // blog page route
    // 'blog-details' => 'pages/blog-details.php',
    // 'admin' => 'pages/admin/dashboard.php', // admin page route
    // 'user' => 'pages/user/dashboard.php', // user page route
    // 'comments' => 'pages/admin/comments.php', // user page route
    // 'manage-blogs' => 'pages/admin/manage-blogs.php', // user page route
    // 'edit-blog' => 'pages/admin/edit-blog.php', // user page route
    

    // // configuration
    // 'registerController' => 'controller/registerController.php',
    // 'loginController' => 'controller/loginController.php',
    // 'logout' => 'controller/logoutController.php',
    // 'commentsController' => 'controller/commentsController.php',
    // 'approveController' => 'controller/approveController.php',
    // 'rejectController' => 'controller/rejectController.php',
    // 'edit-blog-config' => 'controller/editBlogController.php',
    // 'delete-blog-config' => 'controller/deleteBlogController.php',
];




// Check if the URL matches a route
if (array_key_exists($url, $routes)) {
    require $routes[$url];  // Load the appropriate file for the route
} else {
    // If no route matches, show a 404 page
    require 'pages/error_404.php';
}
?>