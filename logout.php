<?php
session_start();
require 'checkloggedin.php';
session_destroy();
header("Location: loginpage.php");
?>