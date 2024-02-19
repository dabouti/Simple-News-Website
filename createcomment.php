<?php
    require 'database.php';
    session_start();

    $comment_id = $_POST['postid'];
    $comment_body = $_POST['commentbody'];
    $comment_username = $_SESSION['username'];
    $comment_date = date('Y-m-d H:i');
    
    $stmt = $mysqli->prepare("insert into comments (comment_username, comment_date, comment_body, comment_id) values (?, ?, ?, ?)");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    
    $stmt->bind_param('sssd', $comment_username, $comment_date, $comment_body, $comment_id);
    
    $stmt->execute();
    
    $stmt->close();
    header("Location: loadpost.php?id=$comment_id");
?>