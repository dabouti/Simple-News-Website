<?php
session_start();
require 'database.php';
require 'checkloggedin.php';
$new_body = $_POST['new_body'];
$post_id = $_POST['post_id'];
$stmt = $mysqli->prepare("update posts set post_body='$new_body' where post_id='$post_id'");
if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->execute();
$stmt->bind_param("s", $new_body);
$stmt->close();
header("Location: main.php");
?>