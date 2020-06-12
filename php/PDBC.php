<?php

$host = 'localhost';
$user = 'lankparb_root';
$password = 'a1dbHE2snGDy';
$database = 'lankparb_tours';

$link = mysqli_connect($host, $user, $password, $database);
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}

