<?php
session_start();
require 'checkloggedin.php';
session_destroy(); //logout user
header("Location: loginpage.php");
exit;
?>