<?php
session_start();
require 'database.php';
$new_body = $_POST['new_body'];
$post_id = $_POST['post_id'];
$stmt = $mysqli->prepare("update comments set comment_body='$new_body' where comment_postid='$post_id' and id = '$comment_id'");
if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->execute();
$stmt->bind_param("s", $new_body);
$stmt->close();
header("Location: main.php");
?>