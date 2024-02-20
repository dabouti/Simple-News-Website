<?php
session_start();
require 'database.php';
$post_id = $_POST['post_id'];


$stmt = $mysqli->prepare("delete from comments where comment_id='$post_id' and id='$id'");
if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->execute();
$stmt->close();

header("Location: main.php");
?>