<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" type="text/css" href="navbar.css">
    <link rel="stylesheet" type="text/css" href="createpostpage.css">
</head>

<body>
    <?php
    session_start();
    require 'checkloggedin.php';
    include('navbar.php');
    ?>
    <div class='formdiv'>
        <form action='createpost.php' method='POST' enctype="multipart/form-data">
            <h1>Create Post</h1>
            <p>
                <label for='title'>Please enter your post title:</label>
                <input type='text' name="title" id="title" placeholder="Enter Post Title" required>
                <!-- send CSRF token below -->
                <input type='hidden' name='token' value='<?php echo $_SESSION['token']; ?>'>

            </p>
            <p>
                <label for='postbody'>Please enter your post body:</label>
                <textarea rows="10" name="postbody" id="postbody" placeholder="Enter Post Body"></textarea>

            </p>
            <p>
                <label for='link'>(OPTIONAL) Please enter your post link (without preceding https://)</label>
                <input type='text' name="link" id="link" placeholder="Enter Link">
            </p>
            <br>
            <!-- input for uploading image below -->
            <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
            <label for="uploadfile_input">(OPTIONAL) (MUST BE JPG/JPEG/PNG) Upload Image</label>
            <input name="uploadedfile" type="file" id="uploadfile_input" />
            <button>Submit</button>
        </form>
    </div>


</body>

</html>