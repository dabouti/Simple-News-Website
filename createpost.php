<?php
require 'database.php';

$title = $_POST['title'];
$postbody = $_POST['postbody'];
$username = $_SESSION['username'];
$currentDate = date("Y-m-d");

$stmt = $mysqli->prepare("insert into posts (post_username, post_date, post_title, post_body) values (?, ?, ?, ?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('ssss', $username, $currentDate, $title, $postbody);

$stmt->execute();

$stmt->close();

?>