<?php

include './PDBC.php';
mysqli_set_charset($link, 'utf8');
$sql = "SELECT COUNT(id_testimonial) FROM testimonial ORDER BY id_testimonial DESC";
$text = "";
if ($tourcount = mysqli_query($link, $sql)) {
    // Fetch one and one row
    $row = mysqli_fetch_row($tourcount);
    $loops = ($row[0] / 5) == round($row[0] / 5) ? round($row[0] / 5) : round($row[0] / 5) + 1;
    $pre = 0;
    $text.="<div class='carousel-inner'>";
    for ($i = 1; $i <= $loops; $i++) {
        
        if ($i == 1) {
            $text .= "<div class='item active'>";
        } else {
            $text .= "<div class='item'>";
        }
        $sql1 = "SELECT * FROM testimonial ORDER BY id_testimonial DESC LIMIT $pre,5";
        if ($tourresult = mysqli_query($link, $sql1)) {
            while ($row = mysqli_fetch_row($tourresult)) {
                $text .= "<div class='row' style='padding:20px'><button style='border: none;'><i class='fa fa-quote-left testimonial_fa' aria-hidden='true'></i></button><p class='testimonial_para'>$row[1]</p><button style='border:none;float:right;'><i class='fa fa-quote-right testimonial_fa' aria-hidden='true'></i></button><div class='row'><div class='col-sm-10'><h4 class='marginbot-0'><strong>$row[2]</strong></h4><p class='testimonial_subtitle'>$row[3]</p></div></div></div>";
            }
        }
        $text .= "</div>";
        $pre = ($i * 5);
    }
    $text.="</div>";

    // Free result set
    // mysqli_free_result($tourcount);
    // mysqli_free_result($tourresult);
}
echo $text;
