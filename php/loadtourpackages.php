<?php

include './PDBC.php';
mysqli_set_charset($link, 'utf8');
$sql = "SELECT * FROM tour";
$text = "";
if ($tourresult = mysqli_query($link, $sql)) {
    while ($tourrow = mysqli_fetch_row($tourresult)) {
        $text .="<div class='panel panel-default'>";
        $text .="    <div class='panel-heading'>";
        $text .="        <h4 class='panel-title' style='text-align:center;'>";
        $text .="            <a data-toggle='collapse' data-parent='#accordion' href='#collapse$tourrow[0]'><img src='img/packages/$tourrow[2]' style='width:100%;margin-bottom:10px;'><span class='tour-title'>$tourrow[1]</span</a>";
        $text .="        </h4>";
        $text .="    </div>";
        $text .="    <div id='collapse$tourrow[0]' class='panel-collapse collapse'>";
        $text .="        <div class='panel-body'>";
        $text .="            <div class='panel-group' id='accordion$tourrow[0]'>";
        $sql1 = "SELECT * FROM package WHERE tour_id='" . $tourrow[0] . "'";
        if ($packageresult = mysqli_query($link, $sql1)) {
            while ($packagerow = mysqli_fetch_row($packageresult)) {
                $text .="                <div class='panel panel-default'>";
                $text .="                    <div class='panel-heading'>";
                $text .="                        <h4 class='panel-title text-left'>";
                $text .="                            <a data-toggle='collapse' data-parent='accordion$tourrow[0]' href='#collapse$tourrow[0]$packagerow[0]'>$packagerow[1]<i class='more-less glyphicon glyphicon-chevron-down'></i></a>";
                $text .="                        </h4>";
                $text .="                    </div>";
                $text .="                    <div id='collapse$tourrow[0]$packagerow[0]' class='panel-collapse collapse'>";
                $text .="                        <div class='panel-body'>";
                $sql2 = "SELECT * FROM trip WHERE package_id='" . $packagerow[0] . "'";
                if ($tripresult = mysqli_query($link, $sql2)) {
                    while ($triprow = mysqli_fetch_row($tripresult)) {
                        $text .="                            <h4 class='marginbot-10 text-left'>$triprow[1]</h4>";
                        $text .="                            <p>$triprow[2]</p>";
                        $text .="                            <h5 class='marginbot-10'>Things to see on the way & on the day</h5>";
                        $text .="                            <ul>";
                        $todo = explode(",", $triprow[3]);
                        for ($x = 0; $x < count($todo); $x++) {
                            $text .="                                <li>$todo[$x]</li>";
                        }
                        $text .="                            </ul>";
                    }
                }
                $text .="                        </div>";
                $text .="                    </div>";
                $text .="                </div>";
            }
        }
        $text .="            </div>";
        $text .="        </div>";
        $text .="    </div>";
        $text .="</div>";
    }
    // Free result set
    mysqli_free_result($tourresult);
    mysqli_free_result($packageresult);
    mysqli_free_result($tripresult);
}
echo $text;
