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
    $stmt = $mysqli->prepare("select post_title, post_username, post_date, post_body, post_link from posts where post_id='$post_id'");
    if (!$stmt) {
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->execute();
    $stmt->bind_result($post_title, $post_username, $post_date, $post_body, $post_link);

    $stmt->fetch();
    echo "<h1>$post_title</h1>";
    echo "posted by: $post_username on $post_date";
    echo "<br><br> Body: $post_body";
    echo "<br> Link: <a href='$post_link'>$post_link</a>";
    if ($_SESSION['username'] == $post_username) {
        echo "<form action='edittitle.php' method='POST'>
            <label for='newtitle'>Please enter your new post title:</label>
            <textarea name='newtitle' id='newtitle'>$post_title</textarea>
            <input type='hidden' name='post_id' value='$post_id'>
            <button>Submit New title</button>
        </form>
        <form action='editbody.php' method='POST'>
            <label for='postbody'>Please enter your post body:</label>
            <textarea name='new_body' id='postbody'>$post_body</textarea>
            <input type='hidden' name='post_id' value='$post_id'>
            <button>Submit New Body</button>
        </form>
        <form action='deletepost.php' method='POST'>
            <input type='hidden' name='post_id' value='$post_id'>
            <button>Delete Post</button>
        </form>";
    }
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
    $stmt = $mysqli->prepare("select comment_username, comment_date, comment_body from comments where comment_postid='$post_id'");
    if (!$stmt) {
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }

    $stmt->execute();

    $stmt->bind_result($comment_username, $comment_date, $comment_body);

    echo "<ol>\n";
    while ($stmt->fetch()) {
        printf(
            "\t<li>%s on %s<br> Comment: %s</li>\n",
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