<?php
include("db.php");

function generateRandomPassword($length = 8)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];

    // Check if the username already exists
    $checkUsernameQuery = "SELECT * FROM users WHERE username='$username'";
    $checkUsernameResult = $conn->query($checkUsernameQuery);

    if ($checkUsernameResult->num_rows > 0) {
        $errorMessage = "Username '$username' already exists. Please choose a different username.";
    } else {
        // Username is unique, proceed with registration
        $realPassword = generateRandomPassword();
        $hashedPassword = password_hash($realPassword, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (username, password, real_password, is_admin) VALUES ('$username', '$hashedPassword', '$realPassword', 0)";

        if ($conn->query($sql) === TRUE) {
            $successMessage = "User registered successfully! Password: $realPassword";
        } else {
            $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <?php include 'meta.php' ?>
    <?php include 'cdn.php' ?>
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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


            <form method="post" action="signup.php">
                <?php if ($errorMessage) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $errorMessage; ?>
                    </div>
                <?php endif; ?>
                <?php if ($successMessage) : ?>
                    <script>
                        $(document).ready(function() {
                            $("#successModal").modal('show');
                        });
                    </script>
                <?php endif; ?>
                <div class="forms-title">
                    <h2>Admin - Sign Up For Users</h2>
                </div>
                <div class="forms">
                    <label>Student ID Number:</label>
                    <input type="text" name="username" placeholder="Enter your Student ID Number" required>
                </div>
                <div class="forms">
                    <button type="submit">Sign up</button>
                </div>
                <div class="forms">
                    <a href="login.php">login</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><?php echo $successMessage; ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/authentication.js"></script>
</body>

</html>