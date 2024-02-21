<?php
require 'database.php';

$username = $_POST['username'];
$hashed_password = password_hash($_POST['password'], PASSWORD_BCRYPT);


$stmt = $mysqli->prepare("select username from user where username = ?");
if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->bind_result($user);

if ($stmt->fetch()) {
    $stmt->close();
    header("Location: loginpage.php");
    exit;
}
$stmt->close();

$stmt = $mysqli->prepare("insert into user (username, hashed_password) values (?, ?)");
if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('ss', $username, $hashed_password);
$stmt->execute();
$stmt->close();
header("Location: loginpage.php");
exit;
?>