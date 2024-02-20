<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" type="text/css" href="navbar.css">
</head>

<body>
    <?php
    session_start();
    require 'checkloggedin.php';
    include('navbar.php');
    ?>
    <form action='createpost.php' method='POST'>
        <p>
        <label for='title'>Please enter your post title:</label>
        <input type='text' name="title" id="title" placeholder="Enter Post Title" required>
</p>
<p>
        <label for='postbody'>Please enter your post body:</label>
        <textarea name="postbody" id="postbody" placeholder="Enter Post Body"></textarea>
</p>
<p>
        <label for='link'>Please enter your post link: (OPTIONAL)</label>
        <input type='text' name="link" id="link" placeholder="Enter Link">
</p>
<br>
        <button>Submit</button>
    </form>



</body>

</html>