<?php
require 'database.php';
session_start();
require 'checkloggedin.php';
$comment_postid = $_POST['postid']; // read post variables from loadpage.php
$comment_body = $_POST['commentbody'];
$comment_username = $_SESSION['username'];
$comment_date = date('Y-m-d H:i'); 
if (!hash_equals($_SESSION['token'], $_POST['token'])) { // check for validity of CSRF token
    die("Request forgery detected");
}

$stmt = $mysqli->prepare("insert into comments (comment_username, comment_date, comment_body, comment_postid) values (?, ?, ?, ?)");
if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('sssd', $comment_username, $comment_date, $comment_body, $comment_postid);

$stmt->execute();

$stmt->close();
header("Location: loadpost.php?id=$comment_postid");
exit;
?>