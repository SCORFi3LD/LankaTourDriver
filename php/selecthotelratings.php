<?php

include './PDBC.php';
mysqli_set_charset($link, 'utf8');

$sql = "SELECT * FROM hotel_ratings";
$result = mysqli_query($link,$sql);
$data = array();
while($row = mysqli_fetch_assoc($result)){
   $data[] = $row;
}
 
header('Content-Type:Application/json');
echo json_encode($data);