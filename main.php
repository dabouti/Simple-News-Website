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
    if (isset($_POST['guest'])) {
        $_SESSION['guest'] = true;
    } else {
        $_SESSION['guest'] = false;
    }
    include('navbar.php');
    ?>


</body>

</html>