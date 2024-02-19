<?php
session_start();
require 'database.php';
$newtitle = $_POST['newtitle'];
$post_id = $_POST['post_id'];
$stmt = $mysqli->prepare("update posts set post_title='$newtitle' where post_id='$post_id'");
if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->execute();
$stmt->bind_param("s", $newtitle);
$stmt->close();
header("Location: main.php");
?>