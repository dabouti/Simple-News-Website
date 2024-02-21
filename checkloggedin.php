<?php
if (!(isset($_SESSION['loggedin']))) { //checks if user is logged in
    header('Location: main.php');
    exit;
}
?>