<?php
include "connection.php";
$id = $_GET["id"];
$conn->query("DELETE FROM users WHERE id=$id");
header("Location: dashboard.php");
exit;
