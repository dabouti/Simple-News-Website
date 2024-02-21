<?php
require 'database.php';
session_start();
require 'checkloggedin.php';
$title = $_POST['title']; // reading post variables from createpostpage.php
$postbody = $_POST['postbody'];
$username = $_SESSION['username'];
$link = $_POST['link'];
$currentDate = date('Y-m-d H:i');
$zero = 0; // will be inserted into votes columm of posts, as votes always starts at 0
if (!hash_equals($_SESSION['token'], $_POST['token'])) { // check for validity of CSRF token
    die("Request forgery detected");
}

$stmt = $mysqli->prepare("insert into posts (post_username, post_date, post_title, post_body, post_link, votes) values (?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('sssssi', $username, $currentDate, $title, $postbody, $link, $zero);

$stmt->execute();
$post_id = $mysqli->insert_id; // get post_id from the post we just created
$stmt->close();

if(isset($_FILES["uploadedfile"])) {
	$filename = basename($_FILES['uploadedfile']['name']);
	if (!preg_match('/^[\w_\.\-]+$/', $filename)) {
		header("Location: main.php");
		exit;
	}
	$file_path = "/home/dabouti/public_html/mod3images/$filename";
	  $imageFileType = strtolower(pathinfo($file_path, PATHINFO_EXTENSION)); // check if file is of type jpg, jpeg, png
	  if (!in_array($imageFileType, array('jpg', 'jpeg', 'png'))) {
		  header("Location: main.php");
		  exit;
	  }
	if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $file_path)) { //move the file to the directory
		$stmt = $mysqli->prepare("update posts set filename = ? where post_id = ?"); // update filename column to the input filename
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