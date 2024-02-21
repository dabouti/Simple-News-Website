<?php
session_start();
require 'database.php';
require 'checkloggedin.php';
$newtitle = $_POST['newtitle'];
$post_id = $_POST['post_id'];
if (!hash_equals($_SESSION['token'], $_POST['token'])) { // check for validity of CSRF token
    die("Request forgery detected");
}
$stmt = $mysqli->prepare("update posts set post_title = ? where post_id = ?"); //update post title
if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param("si", $newtitle, $post_id);
$stmt->execute();
$stmt->close();
header("Location: loadpost?id=$post_id");
exit;
?>