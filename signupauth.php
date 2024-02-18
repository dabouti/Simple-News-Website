<?php
require 'database.php';

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $mysqli->prepare("select username from user where username='$username'");
if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->execute();
$stmt->bind_result($user);
if ($stmt->fetch()) {
    header("Location: signuppage.php");
    exit;
}

$stmt->close();

$stmt = $mysqli->prepare("insert into user (username, password) values (?, ?)");
if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('ss', $username, $password);
$stmt->execute();
$stmt->close();
header("Location: loginpage.php");
exit;
?>