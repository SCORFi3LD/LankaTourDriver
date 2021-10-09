<?php

$host = 'localhost';
$user = 'root';
$password = '1234';
$database = 'lankparb_tours';

$link = mysqli_connect($host, $user, $password, $database);
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}

