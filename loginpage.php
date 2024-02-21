<?php
session_start();
if ($_SESSION['loggedin'] == true) {
    header("Location: main.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="loginpage.css">
</head>

<body>
    <div class='formdiv'>
        <h1>Login</h1>
        <!-- login form -->
        <form action='loginauth.php' method='POST'>
            <label for='username'>Username</label>
            <input type='text' name="username" id="username" placeholder="Enter Username">
            <br>
            <br>
            <label for='password'>Password</label>
            <input type='password' name="password" id="password" placeholder="Enter Password">
            <div class='buttondiv'>
                <button>Login</button>
            </div>
            <br>
            <br>
        </form>
    </div>
    <!-- signup form -->
    <div class='formdiv'>
        <h1>Sign Up</h1>
        <form action='signupauth.php' method='POST'>
            <label for='username2'>Username</label>
            <input type='text' name="username" id="username2" placeholder="Enter Username">
            <br>
            <br>
            <label for='password2'>Password</label>
            <input type='password' name="password" id="password2" placeholder="Enter Password">
            <div class='buttondiv'>
                <button>Sign Up</button>
            </div>
        </form>
    </div>
    <form action='main.php'>
        <br>
        <!-- continue as guest -->
        <div class='buttondiv'>
            <button>OR Continue as Guest</button>
        </div>
    </form>

</body>

</html>