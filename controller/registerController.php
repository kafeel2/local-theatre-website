<?php
include 'database/config.php';
session_start();

// Input sanitization, taking away any spaces
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$created_on = trim($_POST['created_on']);
$role = trim($_POST['role']); 


// Validate username (alphanumeric)
if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
    $_SESSION['status_message'] = 'Username is not valid! Only alphanumeric characters are allowed.';
    header('Location: register');
    exit();
}

// Validate password (between 5 and 20 characters)
if (strlen($password) < 5 || strlen($password) > 20) {
    $_SESSION['status_message'] = 'Password must be between 5 and 20 characters long!';
    header('Location: register');
    exit();
}

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['status_message'] = 'Invalid email format!';
    header('Location: register');
    exit();
}

// Check if email already exists
$stmt = $conn->prepare('SELECT user_id FROM users WHERE email = ?');
if (!$stmt) {
    die("Database error: " . $conn->error); // Debugging SQL error
}
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $_SESSION['status_message'] = 'Email address already exists! Please login.';
    $stmt->close();
    header('Location: login');
    exit();
} else {
    $stmt->close();

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database
   $stmt = $conn->prepare("INSERT INTO users (username, email, password, role, created_on)
    VALUES (?, ?, ?, 'user', NOW())");

    if (!$stmt) {
        die("Database error: " . $conn->error); // Debugging SQL error
    }
    
    $stmt->bind_param('sss', $username, $email, $hashed_password);
    
    if ($stmt->execute()) {
        $_SESSION['status_message'] = 'Account successfully created! You can now log in.';
        header('Location: login');
    } else {
        $_SESSION['status_message'] = 'Account creation failed. Please try again later.';
        header('Location: register');
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>
