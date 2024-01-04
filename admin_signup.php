<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username already exists
    $checkUsernameQuery = "SELECT * FROM admins WHERE username = '$username'";
    $result = $conn->query($checkUsernameQuery);

    if ($result->num_rows > 0) {
        $error_message = "Username already exists. Please choose a different username.";
    } else {
        // Insert new admin if the username is not already taken
        $insertQuery = "INSERT INTO admins (username, password) VALUES ('$username', '$password')";

        if ($conn->query($insertQuery) === TRUE) {
            $success_message = "Admin registration successful";
        } else {
            $error_message = "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    }
}
?>

<!-- Your HTML code remains unchanged -->


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'meta.php' ?>
    <?php include 'cdn.php' ?>
    <title>Sign Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                    echo "<p style='color: red;'>$error_message</p>";
                } elseif (isset($success_message)) {
                    echo "<script>
                    // Display Bootstrap modal
                    document.addEventListener('DOMContentLoaded', function () {
                        $('#myModal').modal('show');
                    });
                    // Redirect after 2 seconds
                    setTimeout(function () {
                        window.location.href = 'admin_login.php';
                    }, 2000);
                  </script>";
                }
                ?>
                <div class="forms-title">
                    <h2>Super Admin- Sign up</h2>
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
                    <button type="submit">Sign Up</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Admin registration successful. Redirecting to login...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>