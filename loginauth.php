<?php
require 'database.php';
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $mysqli->prepare("select username, password from user where username='$username' and password='$password'");
if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->execute();
$stmt->bind_result($user, $password);
if ($stmt->fetch()) {
    $_SESSION['loggedin'] = true;
    header("Location: main.php");
} else {
    header("Location: loginpage.php");
}

$stmt->close();
?>