<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $location = $_POST['location'];
    $date_of_birth = $_POST['date_of_birth'];
    $zip_code = $_POST['zip_code'];

    // Store user data in session 
    $_SESSION['users'][$username] = [
        'username' => $username,
        'password' => $password,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'location' => $location,
        'date_of_birth' => $date_of_birth,
        'zip_code' => $zip_code
    ];

    // Redirect to login page after successful registration
    header('Location: login.html');
    exit();
} else {
    // Handle invalid request method
    header('HTTP/1.1 405 Method Not Allowed');
    exit('Method Not Allowed');
}
?>
