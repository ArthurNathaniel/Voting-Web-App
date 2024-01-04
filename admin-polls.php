<?php
session_start();

// Check if the admin is logged in, else redirect to the login page
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Include your database connection file (db.php)
include("db.php");

// Fetch vote records from the database
$sql = "SELECT name, votes_count FROM contestants";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'meta.php' ?>
    <?php include 'cdn.php' ?>
    <title>Poll / Result </title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/authentication.css">
    <link rel="stylesheet" href="./css/admin_base.css">
</head>

<body>
    <?php include 'admin-sidebar.php' ?>

    <!-- Page Content -->
    <div class="content">
        <h2>Polls - Vote Records</h2>

        <!-- Display Vote Records in Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>Contestant Name</th>
                    <th>Votes Count</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through the result set and display vote records
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['votes_count'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
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