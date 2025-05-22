<?php
session_start();
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($query);

    if ($result && $row = $result->fetch_assoc()) {
        if (password_verify($password, $row["password"])) {
            $_SESSION["user"] = $username;
            header("Location: dashboard.php");
            exit;
        }
    }
    $error = "Login gagal! Username atau password salah.";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
        }
        .login-box {
            max-width: 300px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
        }
        .login-box h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-box input[type="text"],
        .login-box input[type="password"],
        .login-box input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin: 6px 0;
            font-size: 16px;
        }
        .error {
            color: red;
            font-size: 14px;
            margin: 10px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required />
            <input type="password" name="password" placeholder="Password" required />
            <?php if (isset($error)) : ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <input type="submit" value="Login" />
        </form>
    </div>
</body>
</html>
