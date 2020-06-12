<?php

if ($_POST) {
    $strName = $_POST["name"];
    $strEmail = $_POST["email"];
    $strMsg = $_POST["message"];

    $to = 'info@lankatourdriver.com';
    $subject = 'Contact Request';

    $headers = "From: " . strip_tags($_POST["email"]) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($_POST["email"]) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $message = '<h3>Contact Request from '.$strName.'</h3><table border="1" width="500"><tbody><tr><td width="20%"><strong>Name</strong></td><td>'.$strName.'</td></tr><tr><td width="20%"><strong>Email</strong></td><td><a href="mailto:'.$strEmail.'">'.$strEmail.'</a></td></tr><tr><td width="20%"><strong>Message</strong></td><td>'.$strMsg.'</td></tr></tbody></table>';

    mail($to, $subject, $message, $headers);  
    echo 'OK';
}