<?php
session_start();
require 'database.php';
$post_id = $_POST['post_id'];


$stmt = $mysqli->prepare("delete from comments where comment_postid='$post_id'");
if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->execute();
$stmt->close();

$stmt = $mysqli->prepare("delete from posts where post_id='$post_id'");
if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->execute();
$stmt->close();
header("Location: main.php");
?>