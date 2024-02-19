<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" type="text/css" href="navbar.css">
</head>

<body>
    <?php
    session_start();
    require 'database.php';
    include('navbar.php');
    $stmt = $mysqli->prepare("select post_title, post_username, post_date, post_id from posts order by post_date desc");
    if (!$stmt) {
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }

    $stmt->execute();
    $stmt->bind_result($post_title, $post_username, $post_date, $post_id);
    echo "<ol>\n";
    while ($stmt->fetch()) {
        printf(
            "\t<li><a href='loadpost.php?id=%s'>%s %s %s</a></li>\n",
            htmlspecialchars($post_id),
            htmlspecialchars($post_title),
            htmlspecialchars($post_username),
            htmlspecialchars($post_date)
        );
    }
    echo "</ol>\n";

    $stmt->close();
    ?>

</body>

</html>