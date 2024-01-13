<?php
include("db.php");
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM contestants";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'meta.php' ?>
    <?php include 'cdn.php' ?>
    <title>dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/authentication.css">
    <link rel="stylesheet" href="./css/vote.css">
</head>

<body>
    <?php include 'header.php' ?>

    <footer>
        <div class="footer_bg">
            <div class="ft-title">
                <div class="ft_logo"></div>
                <h4>NSS Voting App</h4>
                <p>
                    Your voice matters! Thank you for using our voting web app to make your opinions count.
                </p>
            </div>
            <div class="footer-last">
                <span>
                    All Copyright &copy; Reserved
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    | Nathstack Tech
                </span>
            </div>
        </div>
    </footer>

</body>

</html>