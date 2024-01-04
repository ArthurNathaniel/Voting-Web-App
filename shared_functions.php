<?php
function redirectIfNotLoggedIn()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['admin_id'])) {
        header("Location: admin_login.php");
        exit();
    }
}

function logout()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_GET['logout'])) {
        // Unset all session variables
        $_SESSION = array();

        // Destroy the session
        session_destroy();

        // Redirect to login page
        header("Location: admin_login.php");
        exit();
    }
}
