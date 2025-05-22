<?php
session_start();
include "connection.php";

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?= htmlspecialchars($_SESSION["user"]) ?></h2>
    <p>
        <a href="add_user.php">Add User</a> | 
        <a href="logout.php">Logout</a>
    </p>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Username</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row["username"]) ?></td>
                <td><a href="edit_user.php?id=<?= $row["id"] ?>">Edit</a></td>
                <td><a href="delete_user.php?id=<?= $row["id"] ?>" onclick="return confirm('Delete user?')">Delete</a></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
