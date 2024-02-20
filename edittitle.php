<?php
session_start();
require 'database.php';
require 'checkloggedin.php';
$newtitle = $_POST['newtitle'];
$post_id = $_POST['post_id'];
$stmt = $mysqli->prepare("update posts set post_title = ? where post_id = ?");
if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param("si", $newtitle, $post_id);
$stmt->execute();
$stmt->close();
header("Location: main.php");
?>