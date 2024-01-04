<?php
session_start();

// Check if the admin is logged in, else redirect to the login page
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Logout logic
if (isset($_GET['logout'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to login page
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'meta.php' ?>
    <?php include 'cdn.php' ?>
    <title>Super Admin Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/authentication.css">
    <link rel="stylesheet" href="./css/admin_base.css">
</head>

<body>
   <?php include 'admin-sidebar.php'?>

    <!-- Page Content -->
    <div class="content">
        <h2>Admin Dashboard</h2>
        <p>This is a simple admin dashboard with a sidebar using Bootstrap.</p>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Custom JavaScript for Toggle -->
    <script>
        function toggleSidebar() {
            var sidebar = document.querySelector('.sidebar');
            var content = document.querySelector('.content');
            sidebar.classList.toggle('active');
            content.classList.toggle('active');
        }
    </script>
</body>

</html>