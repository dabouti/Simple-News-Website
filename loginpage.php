<?php
session_start();
if ($_SESSION['loggedin'] == true) {
    header("Location: main.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>

<body>
    <form action='loginauth.php' method='POST'>
        <label for='username'>Username:</label>
        <input type='text' name="username" id="username" placeholder="Enter Username">
        <br>
        <br>
        <label for='password'>Password:</label>
        <input type='password' name="password" id="password" placeholder="Enter Password">
        <button>Submit</button>
        <br>
        <br>
    </form>
    <p>Sign Up:</p>
    <form action='signupauth.php' method='POST'>
        <label for='username'>Username:</label>
        <input type='text' name="username" id="username" placeholder="Enter Username">
        <br>
        <br>
        <label for='username'>Password:</label>
        <input type='text' name="password" id="password" placeholder="Enter Password">
        <button>Submit</button>
        <br>
        <br>
    </form>

    <form action='main.php'>
        <button>Continue as guest</button>
    </form>

</body>

</html>