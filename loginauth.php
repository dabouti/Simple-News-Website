<?php
require 'database.php';
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $mysqli->prepare("select COUNT(*), username, hashed_password from user where username = ?"); //check for username and hashed password in user database when logging in against input username and password
if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($cnt, $user, $pwd_hash);
if ($stmt->fetch()) {
    if ($cnt == 1 && password_verify($password, $pwd_hash)) { // verify password and hashed password match
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['token'] = bin2hex(random_bytes(32)); // generate random 32 byte token on successful login
        $stmt->close();
        header("Location: main.php");
        exit;
    } else {
        $stmt->close();
        header("Location: loginpage.php");
        exit;
    }
} else {
    $stmt->close();
    header("Location: loginpage.php");
    exit;
}

?>