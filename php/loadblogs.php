<?php

include './PDBC.php';
mysqli_set_charset($link, 'utf8');
$sql = "SELECT * FROM blog WHERE lang='en' AND hidden='0' ORDER BY id_blog DESC LIMIT ".$_GET['page'].", 10";
$text = "";
if ($blogResult = mysqli_query($link, $sql)) {
    while ($row = mysqli_fetch_row($blogResult)) {
        $now = time();
        $publishedDate = strtotime($row[5]);
        $elapsedDays = round(($now - $publishedDate) / 86400);
        $text .= '<div class="media"><div class="media-left"><img alt="blogimage" class="media-object" src="'.$row[4].'" style="width: 100px; height: 100px; object-fit: cover;"></div><div class="media-body"><h5 class="media-heading">'.$row[1].'</h5><div class="meta"><span>Published '.$elapsedDays.' days ago</span></div>'.substr($row[3], 0, 150).'...<p class="media-link"><a href="blog_single.php?id='.$row[0].'">Read more →</a></p></div></div>';
    }
}

echo $text;