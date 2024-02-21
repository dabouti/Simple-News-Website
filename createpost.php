<?php
require 'database.php';
session_start();
require 'checkloggedin.php';
$title = $_POST['title'];
$postbody = $_POST['postbody'];
$username = $_SESSION['username'];
$link = $_POST['link'];
$currentDate = date('Y-m-d H:i');
if (!hash_equals($_SESSION['token'], $_POST['token'])) {
    die("Request forgery detected");
}

$stmt = $mysqli->prepare("insert into posts (post_username, post_date, post_title, post_body, post_link) values (?, ?, ?, ?, ?)");
if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('sssss', $username, $currentDate, $title, $postbody, $link);

$stmt->execute();
$post_id = $mysqli->insert_id;
$stmt->close();

if(isset($_FILES["uploadedfile"])) {
	$filename = basename($_FILES['uploadedfile']['name']);
	if (mime_content_type($filename) != 'image/jpeg' && mime_content_type($filename) != 'image/png') {
    	header("Location: main.php");
		exit;
}
	if (!preg_match('/^[\w_\.\-]+$/', $filename)) {
		header("Location: main.php");
		exit;
	}
	$file_path = "/home/dabouti/public_html/mod3images/$filename";
	if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $file_path)) { //move the file to the directory
		$stmt = $mysqli->prepare("update posts set filename = ? where post_id = ?");
		if (!$stmt) {
			printf("Query Prep Failed: %s\n", $mysqli->error);
			exit;
		}
		$stmt->bind_param('si', $filename, $post_id);
		$stmt->execute();
		$stmt->close();
	} else {
		header("Location: main.php");
		exit;
	}
}

header("Location: main.php");
exit;
?>