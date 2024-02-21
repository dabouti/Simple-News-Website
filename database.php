<?php
$mysqli = new mysqli('localhost', 'sql_user', 'dees', 'mod3group'); // connect to database

if ($mysqli->connect_errno) {
    printf("Connection Failed: %s\n", $mysqli->connect_error); // if unable to correct
    exit;
}
?>