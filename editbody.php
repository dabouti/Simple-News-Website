<?php
session_start();
require 'database.php';
require 'checkloggedin.php';
$new_body = $_POST['new_body'];
$post_id = $_POST['post_id'];
$stmt = $mysqli->prepare("update posts set post_body = ? where post_id = ?");
if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param("si", $new_body, $post_id);
$stmt->execute();
$stmt->close();
header("Location: main.php");
?>