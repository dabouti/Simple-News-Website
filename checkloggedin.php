<?php
if (!(isset($_SESSION['loggedin']))) {
    header('Location: main.php');
    exit;
}
?>