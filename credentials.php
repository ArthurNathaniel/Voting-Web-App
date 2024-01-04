<?php
include("db.php");

$sql = "SELECT username, real_password FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Credentials</title>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/credentials.css">
</head>

<body>
    <div class="all">
        <div class="table-all">
            <h2>User Credentials</h2>
            <table border="1">
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                </tr>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>{$row['username']}</td><td>{$row['real_password']}</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>

<?php
$conn->close();
?>