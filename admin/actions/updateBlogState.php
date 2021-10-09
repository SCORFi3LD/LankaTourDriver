<?php

include '../../php/PDBC.php';

$update = "Error";

if (isset($_GET['id'])) {
    $blogId = $_GET['id'];
    $state = $_GET['state'] == 0 ? 1 : 0;

    $updateSql = "UPDATE blog SET hidden='$state' WHERE id_blog='$blogId'";
    mysqli_query($link, $updateSql);
    
    $update = "Success";
}

echo $update;

