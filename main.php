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
    ?>
    <form action="main.php" method="POST">
        <button name="sortBy" value="ascending">Sort By Date Ascending</button>
        <button name="sortBy" value="descending">Sort By Date Descending</button>
        <button name="sortBy" value="alphabetical">Sort By Alphabetical Order</button>
    </form>
    <?php
    if($_POST['sortBy'] == "descending") {
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
            "\t<li><a class='postlink' href='loadpost.php?id=%s'><p class='posttitle'>%s</p></a><p class='postdetails'>%s on %s</p></li>\n",
            htmlspecialchars($post_id),
            htmlspecialchars($post_title),
            htmlspecialchars($post_username),
            htmlspecialchars($post_date)
        );
    }
    echo "</ol>\n";

    $stmt->close();
}
else if($_POST['sortBy'] == "alphabetical") {
    $stmt = $mysqli->prepare("select post_title, post_username, post_date, post_id from posts order by post_title");
    if (!$stmt) {
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }

    $stmt->execute();
    $stmt->bind_result($post_title, $post_username, $post_date, $post_id);
    echo "<ol>\n";
    while ($stmt->fetch()) {
        printf(
            "\t<li><a class='postlink' href='loadpost.php?id=%s'><p class='posttitle'>%s</p></a><p class='postdetails'>%s on %s</p></li>\n",
            htmlspecialchars($post_id),
            htmlspecialchars($post_title),
            htmlspecialchars($post_username),
            htmlspecialchars($post_date)
        );
    }
    echo "</ol>\n";

    $stmt->close();
}
else {
    $stmt = $mysqli->prepare("select post_title, post_username, post_date, post_id from posts order by post_date");
    if (!$stmt) {
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }

    $stmt->execute();
    $stmt->bind_result($post_title, $post_username, $post_date, $post_id);
    echo "<ol>\n";
    while ($stmt->fetch()) {
        printf(
            "\t<li><a class='postlink' href='loadpost.php?id=%s'><p class='posttitle'>%s</p></a><p class='postdetails'>%s on %s</p></li>\n",
            htmlspecialchars($post_id),
            htmlspecialchars($post_title),
            htmlspecialchars($post_username),
            htmlspecialchars($post_date)
        );
    }
    echo "</ol>\n";

    $stmt->close();
}
    ?>

</body>

</html>