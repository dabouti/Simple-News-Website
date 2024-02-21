<div class="navbar">
    <a href="main.php">Home</a>
    <a href="createpostpage.php">Create Post</a>
    <?php
    if (!isset($_SESSION['loggedin'])) {
        echo '<a href=loginpage.php>Login</a>';
    } else {
        echo '<a href="logout.php">Logout</a>';
    }
    ?>
</div>