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
        <input type='text' name="username" id="username" placeholder="Username">
        <br>
        <br>
        <label for='password'>Password:</label>
        <input type='text' name="password" id="password" placeholder="Password">
        <button>Submit</button>
        <br>
        <br>
    </form>

    <form action='signuppage.php'>
        <button>Sign Up</button>
    </form>

    <form action='main.php' method='POST'>
        <input type='hidden' name='guest'>
        <button>Continue as guest</button>
    </form>

</body>

</html>