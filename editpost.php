<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
    <?php
    session_start();
    if ($_SESSION['guest'] == true) {
        header('Location: main.php');
    }
    include('navbar.php');

    ?>


</body>

</html>