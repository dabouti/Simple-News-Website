<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link rel="stylesheet" type="text/css" href="navbar.css">
</head>
<body>
    <?php
        session_start();
        require 'database.php';
        include 'navbar.php';
        $post_id = $_GET['id'];
        $stmt = $mysqli->prepare("select post_title, post_username, post_date, post_body from posts where post_id='$post_id'");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->execute();
        $stmt->bind_result($post_title, $post_username, $post_date, $post_body);

        $stmt->fetch();
        echo "<h1>$post_title</h1>";
        echo "posted by: $post_username on $post_date";
        echo "<br><br> Body: $post_body";

        $stmt->close();
    ?>
</body>
</html>