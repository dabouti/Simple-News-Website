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
    <form action=createcomment.php method="POST">
        <input type="hidden" name="postid" value="<?php echo $post_id ?>">
        <br>
        <br>
        <label for="commentbody">Post Comment:</label>
        <textarea name="commentbody" id="commentbody"></textarea>
        <button>Submit Comment</button>
    </form>
<?php
    $stmt = $mysqli->prepare("select comment_username, comment_date, comment_body from comments where comment_id='$post_id'");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }

    $stmt->execute();

    $stmt->bind_result($comment_username, $comment_date, $comment_body);

    echo "<ol>\n";
    while($stmt->fetch()){
        printf("\t<li>%s on %s<br> Comment: %s</li>\n",
            htmlspecialchars($comment_username),
            htmlspecialchars($comment_date),
            htmlspecialchars($comment_body)
        );
    }
    echo "</ol>\n";

    $stmt->close();
    ?>
</body>
</html>