<?php
include("db.php");
include_once("shared_functions.php");

// Check if the admin is logged in, else redirect to the login page
redirectIfNotLoggedIn();

// Logout logic
logout();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $position = $_POST["position"];

    // Handle image upload
    $targetDir = "images/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $imageFileName = uniqid() . "." . $imageFileType;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetDir . $imageFileName)) {
        // Insert the contestant into the database
        $sql = "INSERT INTO contestants (name, position, image_filename) VALUES ('$name', '$position', '$imageFileName')";
        $result = $conn->query($sql);

        if ($result) {
            echo '<script>alert("Contestant added successfully!");</script>';
        } else {
            echo '<script>alert("Error adding contestant: ' . $conn->error . '");</script>';
        }
    } else {
        echo '<script>alert("Error uploading image.");</script>';
    }
}

$conn->close();
?>





<!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include 'meta.php' ?>
        <?php include 'cdn.php' ?>
        <title>Add Contestant</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./css/base.css">
        <link rel="stylesheet" href="./css/authentication.css">
        <link rel="stylesheet" href="./css/admin_base.css">
    </head>

    <body>
        <?php include 'admin-sidebar.php' ?>
        <div class="content">
            <?php include_once 'shared_functions.php'; ?>
            <?php redirectIfNotLoggedIn(); ?>
            <?php logout(); ?>

            <form method="post" action="add_contestant.php" enctype="multipart/form-data">
                <div class="forms">
                    <label>Name:</label>
                    <input type="text" name="name" placeholder="Enter contestant's name" required>
                </div>
                <div class="forms">
                    <label>Position:</label>
                    <input type="text" name="position" placeholder="Enter contestant's position" required>
                </div>
                <div class="forms ds">
                    <label>Image:</label>
                    <input type="file" name="image" accept="image/*" required>
                </div>
                <div class="forms">
                    <button type="submit">Add Contestant</button>
                </div>
            </form>
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