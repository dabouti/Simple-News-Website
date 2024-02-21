<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link rel="stylesheet" type="text/css" href="navbar.css">
    <link rel="stylesheet" type="text/css" href="loadpost.css">
</head>

<body>
    <?php
    session_start();
    require 'database.php';
    include 'navbar.php';
    $post_id = $_GET['id']; // get post id from the URL sent by main.php
    $stmt = $mysqli->prepare("select post_title, post_username, post_date, post_body, post_link, filename from posts where post_id = ?"); //get all info of this post relating its respective post id so we can display it
    if (!$stmt) {
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $stmt->bind_result($post_title, $post_username, $post_date, $post_body, $post_link, $filename);

    $stmt->fetch();
    $post_title = htmlentities($post_title);
    $post_username = htmlentities($post_username); // FIEO policy
    $post_date = htmlentities($post_date);
    $post_body = htmlentities($post_body);
    $post_link = htmlentities($post_link);
    $filename = htmlentities($filename);
    $token = $_SESSION['token']; // get CSRF token
    if($post_title != null) {
    echo "<h1>$post_title</h1>";
    } else {
    echo "Untitled Post";
    }
    echo "<p class='postedby'>posted by: $post_username on $post_date</p>";
    if ($_SESSION['username'] == $post_username) { // if the logged in user created this post, allow them to edit and delete the post
        echo "<div style='float: right; display: block;'>
        <form action='edittitle.php' method='POST'>
            <label for='newtitle'>Please enter a new post title:</label> 
            <textarea name='newtitle' id='newtitle'>$post_title</textarea>
            <input type='hidden' name='post_id' value='$post_id'>    
            <input type='hidden' name='token' value='$token'>
            <button>Submit New title</button>
        </form>
        <form action='editbody.php' method='POST'>
            <label for='postbody'>Please enter a new post body:</label>
            <textarea name='new_body' id='postbody'>$post_body</textarea>
            <input type='hidden' name='post_id' value='$post_id'>
            <input type='hidden' name='token' value='$token'>
            <button>Submit New Body</button>
        </form>
        <form style='float: right;' action='deletepost.php' method='POST'>
            <input type='hidden' name='post_id' value='$post_id'>
            <input type='hidden' name='token' value='$token'>
            <button>Delete Post</button>
        </form>
        </div>";
    }
    echo "<p>Body: $post_body</p>";
    if($post_link != null) { //if link is provided in post, display it
    echo "<p>Link: <a href='https://$post_link'>$post_link</a></p>";
}
    if($filename != null) { //if image file is provided in post, display it
    echo "<img class='postimg' src='http://ec2-3-139-235-111.us-east-2.compute.amazonaws.com/~dabouti/mod3images/$filename' alt='post image'>";
    }
    $stmt->close();
    if ($_SESSION['loggedin'] == true) { // if current user is logged in, allow them to comment
        echo "<form action=createcomment.php method='POST'>
        <input type='hidden' name='postid' value='$post_id'>
        <input type='hidden' name='token' value='$token'>
        <br>
        <br>
        <label for='commentbody'>Post Comment:</label>
        <div><textarea name='commentbody' id='commentbody'></textarea></div>
        <div><button>Submit</button></div>
        <br>
        <br>
    </form>";
    }
    $stmt = $mysqli->prepare("select comment_username, comment_date, comment_body, comment_id from comments where comment_postid = ?"); // get info about comments on this specific post to display them
    if (!$stmt) {
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->bind_param("i", $post_id);

    $stmt->execute();

    $stmt->bind_result($comment_username, $comment_date, $comment_body, $comment_id);

    echo "<ol>\n";
    while ($stmt->fetch()) {
        if ($comment_username == $_SESSION['username']) { // if a comment belongs to current user, allow them to edit it
            echo "<div style='float: right; display: block;'>
            <form action='editcomment.php' method='POST'>
            <label for='new_body'>Edit Comment:</label>
            <textarea name='new_body' id='new_body'>$comment_body</textarea>
            <input type='hidden' name='post_id' value='$post_id'>
            <input type='hidden' name='comment_id' value='$comment_id'>
            <input type='hidden' name='token' value='$token'>
            <button>Edit</button>
            </form>
            </div>";
        }
        printf(
            "\t<li><span class='commentpostedby'>%s on %s</span><br> Comment: %s</li>\n", // print each comment as a li in a ol
            htmlspecialchars($comment_username),
            htmlspecialchars($comment_date),
            htmlspecialchars($comment_body)
        );
        if ($comment_username == $_SESSION['username']) {// if a comment belongs to current user, allow them to edit it
            echo "<form action='deletecomment.php' method='POST'>
            <input type='hidden' name='post_id' value='$post_id'>
            <input type='hidden' name='comment_id' value='$comment_id'>
            <input type='hidden' name='token' value='$token'>
            <button>Delete Comment</button>
            </form>";
        }
        echo "<br>";
    }
    echo "</ol>\n";

    $stmt->close();
    ?>
</body>

</html>