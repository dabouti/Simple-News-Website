<?php
$mysqli = new mysqli('localhost', 'sql_user', 'dees', 'mod3group');

if ($mysqli->connect_errno) {
    printf("Connection Failed: %s\n", $mysqli->connect_error);
    exit;
}
?>