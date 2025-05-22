<?php
include "connection.php";
$id = $_GET["id"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $stmt = $conn->prepare("UPDATE users SET username=? WHERE id=?");
    $stmt->bind_param("si", $username, $id);
    $stmt->execute();
    header("Location: dashboard.php");
    exit;
}
$result = $conn->query("SELECT * FROM users WHERE id=$id");
$row = $result->fetch_assoc();
?>

<h2>Edit User</h2>
<form method="POST">
    Username: <input type="text" name="username" value="<?= $row['username'] ?>"><br>
    <input type="submit" value="Update">
</form>
