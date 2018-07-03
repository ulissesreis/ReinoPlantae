<?php 
$mysqli = new mysqli('localhost', 'user', 'password', 'database');

if ($mysqli->connect_errno) {
    echo "Errno: " . $mysqli->connect_errno;
    echo "<br>Error: " . $mysqli->connect_error;
    exit;
}
$mysqli->set_charset("utf8");