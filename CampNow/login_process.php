<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Simulated user database 
    $users = $_SESSION['users'] ?? []; // Retrieve users from session

    // Check if the username exists 
    if (isset($users[$username])) {
        // Verify password
        if (password_verify($password, $users[$username]['password'])) {
            // Authentication successful
            // Store user data in session 
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $users[$username]['username'];
            $_SESSION['first_name'] = $users[$username]['first_name'];
            $_SESSION['last_name'] = $users[$username]['last_name'];
            $_SESSION['email'] = $users[$username]['email'];
            $_SESSION['location'] = $users[$username]['location'];
            $_SESSION['date_of_birth'] = $users[$username]['date_of_birth'];
            $_SESSION['zip_code'] = $users[$username]['zip_code'];

            // Set a cookie to remember the user's login
            setcookie('campnow_user', $username, time() + (86400 * 30), "/"); // Cookie lasts 30 days

            // Redirect to dashboard 
            header('Location: dashboard.php');
            exit();
        } else {
            // Incorrect password
            header('Location: login.html?error=invalid_password');
            exit();
        }
    } else {
        // User not found
        header('Location: login.html?error=user_not_found');
        exit();
    }
} else {
    // Handle invalid request method
    header('HTTP/1.1 405 Method Not Allowed');
    exit('Method Not Allowed');
}
?>
