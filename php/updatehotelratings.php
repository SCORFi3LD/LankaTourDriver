<?php

$id = $_GET['id'];
$rating = $_GET['rating'];

include './PDBC.php';
mysqli_set_charset($link, 'utf8');
$sql = "SELECT * FROM hotel_ratings WHERE id_hotel_ratings='".$id."'";
if ($resultset = mysqli_query($link, $sql)) {
    if($row = mysqli_fetch_row($resultset)){
        $total_ratings = $row[3] + $rating;
        $total_rators = $row[4] + 1;
        $newrating = number_format(($total_ratings / $total_rators),1,'.','');
        $updatesql = "UPDATE hotel_ratings SET rating='".$newrating."',total_rating='".$total_ratings."',raters='".$total_rators."' WHERE id_hotel_ratings='".$id."'"; 
        mysqli_query($link, $updatesql);
        echo 'Updated!';
    }
}