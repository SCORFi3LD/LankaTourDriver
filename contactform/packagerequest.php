<?php

if ($_POST) {
    $strName = $_POST["name"];
    $strEmail = $_POST["email"];
    $strPackage = $_POST["package"];
    $strAdults = $_POST["adults"];
    $strChild = $_POST["children"];

    $to = 'info@lankatourdriver.com';
    $subject = 'Tour Package Request';

    $headers = "From: " . strip_tags($_POST["email"]) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($_POST["email"]) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $message = '<h3>Contact Request from '.$strName.'</h3>'
            . '<table border="1" width="500">'
            . '<tbody>'
            . '<tr>'
            . '<td width="20%"><strong>Name</strong></td>'
            . '<td>'.$strName.'</td>'
            . '</tr>'
            . '<tr>'
            . '<td width="20%"><strong>Email</strong></td>'
            . '<td><a href="mailto:'.$strEmail.'">'.$strEmail.'</a></td>'
            . '</tr>'
            . '<tr>'
            . '<td width="20%"><strong>Package</strong></td>'
            . '<td>'.$strPackage.'</td>'
            . '</tr>'
            . '<tr>'
            . '<td width="20%"><strong>Adults</strong></td>'
            . '<td>'.$strAdults.'</td>'
            . '</tr>'
            . '<tr>'
            . '<td width="20%"><strong>Children</strong></td>'
            . '<td>'.$strChild.'</td>'
            . '</tr>'
            . '</tbody>'
            . '</table>';
    mail($to, $subject, $message, $headers);  
    echo 'OK';
}