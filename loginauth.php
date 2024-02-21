<?php
require 'database.php';
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $mysqli->prepare("select COUNT(*), username, hashed_password from user where username = ?");
if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($cnt, $user, $pwd_hash);
if ($stmt->fetch()) {
    if ($cnt == 1 && password_verify($password, $pwd_hash)) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: main.php");
        exit;
    } else {
        header("Location: loginpage.php");
        exit;
    }
} else {
    header("Location: loginpage.php");
    exit;
}

$stmt->close();
?>