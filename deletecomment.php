<?php
session_start();
require 'database.php';
require 'checkloggedin.php';
$post_id = $_POST['post_id'];
$comment_id = $_POST['comment_id'];
if (!hash_equals($_SESSION['token'], $_POST['token'])) {
    die("Request forgery detected");
}

$stmt = $mysqli->prepare("delete from comments where comment_postid = ? and comment_id = ?");
if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param("ii", $post_id, $comment_id);
$stmt->execute();
$stmt->close();
header("Location: loadpost?id=$post_id");
exit;
?>