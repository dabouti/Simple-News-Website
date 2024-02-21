<?php
session_start();
require 'database.php';
require 'checkloggedin.php';
$post_id = $_POST['post_id'];
if (!hash_equals($_SESSION['token'], $_POST['token'])) {
    die("Request forgery detected");
}

$stmt = $mysqli->prepare("delete from comments where comment_postid = ?");
if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param("i", $post_id);
$stmt->execute();
$stmt->close();

$stmt = $mysqli->prepare("delete from posts where post_id = ?");
if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param("i", $post_id);
$stmt->execute();
$stmt->close();
header("Location: main.php");
exit;
?>