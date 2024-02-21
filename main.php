<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" type="text/css" href="navbar.css">
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
    <?php
    session_start();
    require 'database.php';
    include('navbar.php');
    if (isset($_POST['vote']) && $_SESSION['loggedin']) { //Checks if the user is logged in and if they pressed the like button. If not, then nothing happens.
        $post_id = $_POST['post_id'];
        $username = $_SESSION['username'];
        $stmt = $mysqli->prepare("select * from upvotes where post_id = ? and username = ?"); //Checks if the user have already liked the post. 
        if (!$stmt) {
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('is', $post_id, $username);
        $stmt->execute();
        $stmt->bind_result($id, $name);
        if ($stmt->fetch()) {
            $stmt->close();
            $delstmt = $mysqli->prepare("delete from upvotes where post_id = ? and username = ?"); //If so, then delete from the table as the user is trying to dislike the post. 
            if (!$delstmt) {
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            $delstmt->bind_param("is", $post_id, $username);
            $delstmt->execute();
            $delstmt->close();

            $substmt = $mysqli->prepare("update posts set votes = votes-1 where post_id = ?"); //Subtracts the number of likes by 1 as a result.
            if (!$substmt) {
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            $substmt->bind_param("i", $post_id);
            $substmt->execute();
            $substmt->close();
        } else {
            $stmt->close();
            $newstmt = $mysqli->prepare("insert into upvotes (post_id, username) values (?, ?)"); //If the user did not like the post yet, then that means the user pressed the button to like the post, so we must indicate into the table that the user have indeed liked the post.
            if (!$newstmt) {
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            $newstmt->bind_param("is", $post_id, $username);
            $newstmt->execute();
            $newstmt->close();

            $addstmt = $mysqli->prepare("update posts set votes = votes+1 where post_id = ?"); //Adds the number of likes by 1 as a result.
            if (!$addstmt) {
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            $addstmt->bind_param("i", $post_id);
            $addstmt->execute();
            $addstmt->close();
        }
    }
    ?>

    <form action="main.php" method="POST">
        <button name="sortBy" value="ascending">Sort By Date Ascending</button>
        <button name="sortBy" value="descending">Sort By Date Descending</button>
        <button name="sortBy" value="alphabetical">Sort By Alphabetical Order</button>
        <button name="sortBy" value="likes">Sort By Number of Likes</button>
    </form>
    <!-- This gives the users the option to choose how the post should be sorted by. -->
    <?php
    if ($_POST['sortBy'] == "descending") { // Based on the selection from the user, it sorts out the order of the post and prints out the title, username of the post, data published, and the number of votes each post has. 
        $stmt = $mysqli->prepare("select post_title, post_username, post_date, post_id, votes from posts order by post_date desc");
        if (!$stmt) {
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }

        $stmt->execute();
        $stmt->bind_result($post_title, $post_username, $post_date, $post_id, $votes);
        echo "<ol>\n";
        while ($stmt->fetch()) {
            printf(
                "\t<li><a class='postlink' href='loadpost.php?id=%s'><p class='posttitle'>%s</p></a>
            <form action='main.php' method='POST'>
            <button name='vote' value='vote'>Like</button>
            <input type='hidden' name='sortBy' value='descending'>
            <input type='hidden' name='post_id' value='$post_id''>
            </form> 
            <p class='postdetails'>%s on %s with %d likes</p></li>\n", // If the like button is pressed, it renders what post the user liked and sends it to the checker which we've explained above in line 17.
                htmlspecialchars($post_id),
                htmlspecialchars($post_title),
                htmlspecialchars($post_username),
                htmlspecialchars($post_date),
                htmlspecialchars($votes)
            );
        }
        echo "</ol>\n";

        $stmt->close();
    } else if ($_POST['sortBy'] == "alphabetical") { //Same process happens for different selections. 
        $stmt = $mysqli->prepare("select post_title, post_username, post_date, post_id, votes from posts order by post_title");
        if (!$stmt) {
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }

        $stmt->execute();
        $stmt->bind_result($post_title, $post_username, $post_date, $post_id, $votes);
        echo "<ol>\n";
        while ($stmt->fetch()) {
            printf(
                "\t<li><a class='postlink' href='loadpost.php?id=%s'><p class='posttitle'>%s</p></a>
            <form action='main.php' method='POST'>
            <button name='vote' value='vote'>Like</button>
            <input type='hidden' name='sortBy' value='alphabetical'>
            <input type='hidden' name='post_id' value='$post_id''>
            </form>
            <p class='postdetails'>%s on %s with %d likes</p></li>\n",
                htmlspecialchars($post_id),
                htmlspecialchars($post_title),
                htmlspecialchars($post_username),
                htmlspecialchars($post_date),
                htmlspecialchars($votes)
            );
        }
        echo "</ol>\n";

        $stmt->close();
    } else if ($_POST['sortBy'] == "likes") {
        $stmt = $mysqli->prepare("select post_title, post_username, post_date, post_id, votes from posts order by votes desc");
        if (!$stmt) {
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }

        $stmt->execute();
        $stmt->bind_result($post_title, $post_username, $post_date, $post_id, $votes);
        echo "<ol>\n";
        while ($stmt->fetch()) {
            printf(
                "\t<li><a class='postlink' href='loadpost.php?id=%s'><p class='posttitle'>%s</p></a>
            <form action='main.php' method='POST'>
            <button name='vote' value='vote'>Like</button>
            <input type='hidden' name='sortBy' value='likes'>
            <input type='hidden' name='post_id' value='$post_id''>
            </form>
            <p class='postdetails'>%s on %s with %d likes</p></li>\n",
                htmlspecialchars($post_id),
                htmlspecialchars($post_title),
                htmlspecialchars($post_username),
                htmlspecialchars($post_date),
                htmlspecialchars($votes)
            );
        }
        echo "</ol>\n";

        $stmt->close();
    } else {
        $stmt = $mysqli->prepare("select post_title, post_username, post_date, post_id, votes from posts order by post_date");
        if (!$stmt) {
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }

        $stmt->execute();
        $stmt->bind_result($post_title, $post_username, $post_date, $post_id, $votes);
        echo "<ol>\n";
        while ($stmt->fetch()) {
            printf(
                "\t<li><a class='postlink' href='loadpost.php?id=%s'><p class='posttitle'>%s</p></a>
            <form action='main.php' method='POST'>
            <button name='vote' value='vote'>Like</button>
            <input type='hidden' name='post_id' value='$post_id''>
            </form>
            <p class='postdetails'>%s on %s with %d likes</p></li>\n",
                htmlspecialchars($post_id),
                htmlspecialchars($post_title),
                htmlspecialchars($post_username),
                htmlspecialchars($post_date),
                htmlspecialchars($votes)
            );
        }
        echo "</ol>\n";

        $stmt->close();
    }
    ?>

</body>

</html>