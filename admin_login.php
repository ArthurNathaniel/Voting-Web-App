<?php
session_start();

if (isset($_SESSION['admin_id'])) {
    // If the admin is already logged in, redirect to the dashboard or home page
    header("Location: admin_dashboard.php");
    exit();
}

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Admin login successful
        $row = $result->fetch_assoc();
        $_SESSION['admin_id'] = $row['id'];
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error_message = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'meta.php' ?>
    <?php include 'cdn.php' ?>
    <title>Admin Login</title>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/authentication.css">
</head>

<body>






    <div class="all">
        <div class="swiper-images">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="./images/slide_01.jpg" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="./images/slide_02.jpg" alt="">
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <div class="forms-all">

            <form method="post" action="">
                <?php
                if (isset($error_message)) {
                    echo "<p class='error'>$error_message</p>";
                }
                ?>
                <div class="forms-title">
                    <h2>Super Admin- Login</h2>
                </div>
                <div class="forms">
                    <label>Username:</label>
                    <input type="text" name="username" placeholder="Enter your username" required>
                </div>
                <div class="forms">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="forms">
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
    <script src="./js/authentication.js"></script>
</body>

</html>