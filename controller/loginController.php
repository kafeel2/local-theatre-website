<?php
// Start the session and include the database configuration file to establish the database connection.
require 'database/config.php';
session_start();

// Check if the login form was submitted with the email and password fields filled.
if (empty($_POST['email']) || empty($_POST['password'])) {
    $_SESSION['status_message'] = 'Please fill in all fields!';
    header('Location: login');
    exit();
}

// Prepare an SQL statement to prevent SQL injection when checking user credentials.
if ($stmt = $conn->prepare('SELECT user_id, password, role FROM users WHERE email = ?')) {
    // Bind the input email parameter to the SQL query and execute the statement.
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();
    $stmt->store_result(); // Store result to check if the email exists.

    // If email exists, bind the result to the variables and fetch data.
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $password, $role);
        $stmt->fetch();

        // Verify the password against the hashed password stored in the database.
        if (password_verify($_POST['password'], $password)) {
            // Password correct, regenerate session ID for security.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['user_id'] = $user_id;
            $_SESSION['role'] = $role;

            // Set secure cookie with email (Only use Secure flag if on HTTPS)
            setcookie("email", $_POST['email'], time() + 86400, "/", "", false, true);

            // Redirect user based on their role.
            if ($role == 'admin') {
                header('Location: admin/dashboard'); // Redirect admin to the admin dashboard.
            } else {
                header('Location: user/dashboard'); // Redirect user to the user dashboard.
            }
            exit();
        } else {
            $_SESSION['status_message'] = 'Incorrect email or password!';
            header('Location: login');
            exit();
        }
    } else {
        $_SESSION['status_message'] = 'Incorrect email or password!';
        header('Location: login');
        exit();
    }

    $stmt->close();
} else {
    $_SESSION['status_message'] = 'Login system error. Please try again later.';
    header('Location: login');
    exit();
}
?>