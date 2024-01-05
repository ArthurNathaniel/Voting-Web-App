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

    <div class="vote-all">
        <div class="vote-grid">
            <?php
            // Display contestants dynamically
            while ($row = $result->fetch_assoc()) {
                echo '<div class="vote-card">';
                // Set the background image for vote-image
                echo '<div class="vote-image" style="background-image: url(\'images/' . $row['image_filename'] . '\');"></div>';
                echo '<div class="vote-info">';
                echo '<h5>' . $row['name'] . '</h5>';
                echo '<p>' . $row['position'] . '</p>';
                echo '<div class="vote-btn">';
                echo '<button>Vote</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>


    </div>
    <div class="log">
        <a href="log.php">Logout</a>
    </div>
    <div class="footer">
        <div class="footer-title">
            <h2>NSS Voting Web Application</h2>
        </div>
    </div>
</body>

</html>