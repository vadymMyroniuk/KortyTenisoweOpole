<?php

$host = '127.0.0.1';
$db_name   = 'korty';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$db = mysqli_connect($host, $user, $pass, $db_name);
if ($db->connect_error) {
    array_push($errors, "The database is not connected!");
}