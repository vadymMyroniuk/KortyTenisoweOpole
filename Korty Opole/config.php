<?php

$host = '127.0.0.1';
$db   = 'korty';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$db = mysqli_connect('127.0.0.1', 'root', '', 'korty');
if ($db->connect_error) {
    array_push($errors, "Database not connected!");
}