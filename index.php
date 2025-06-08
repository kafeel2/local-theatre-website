<?php
// Get the requested URL from the 'url' query parameter
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';

// Define available routes (URL => corresponding PHP file)
$routes = [
    '' => 'pages/home.php',          // Home route
    'blog' => 'pages/blog.php',          // Blog page route
    'blog-info' => 'pages/blog-info.php', // Blog info page route
    'shows' => 'pages/shows.php',          // Shows page route





    
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