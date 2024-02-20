<?php
session_start();
require 'database.php';
$post_id = $_POST['post_id'];
$comment_id = $_POST['comment_id'];


$stmt = $mysqli->prepare("delete from comments where comment_postid='$post_id' and comment_id='$comment_id'");
if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->execute();
$stmt->close();
header("Location: loadpost?id=$post_id");
?>