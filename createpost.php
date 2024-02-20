<?php
require 'database.php';
session_start();
require 'checkloggedin.php';
$title = $_POST['title'];
$postbody = $_POST['postbody'];
$username = $_SESSION['username'];
$link = $_POST['link'];
$currentDate = date('Y-m-d H:i');

$stmt = $mysqli->prepare("insert into posts (post_username, post_date, post_title, post_body, post_link) values (?, ?, ?, ?, ?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('sssss', $username, $currentDate, $title, $postbody, $link);

$stmt->execute();
$stmt->close();
header("Location: main.php");
exit;
?>