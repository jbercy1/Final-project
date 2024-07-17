<?php
session_start();


// Clear the cookie
if(isset($_COOKIE['campnow_user'])) {
    setcookie('campnow_user', '', time() - 3600, '/');
}

// Redirect to the login page 
header('Location: login.html'); 
exit();
?>
