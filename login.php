<?php
include("db.php");

$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Set 'admin' key in the session
            session_start();
            $_SESSION['admin'] = $username;

            // Redirect to dashboard.php after successful login
            header("Location: dashboard.php");
            exit();
        } else {
            $errorMessage = "Invalid password";
        }
    } else {
        $errorMessage = "User not found";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <?php include 'meta.php' ?>
    <?php include 'cdn.php' ?>
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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
            <form method="post" action="login.php">
                <div class="forms-title">
                    <h2>User - Login</h2>
                </div>
                <div class="forms">
                    <label>Student ID Number:</label>
                    <input type="text" name="username" placeholder="Enter your student ID number" required>
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


    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><?php echo $errorMessage; ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        <?php if ($errorMessage) : ?>
            $(document).ready(function() {
                $("#errorModal").modal('show');
            });
        <?php endif; ?>
    </script>
    <script src="./js/authentication.js"></script>
</body>

</html>