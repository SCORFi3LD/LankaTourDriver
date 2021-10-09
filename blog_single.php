<?php
include 'php/PDBC.php';
mysqli_set_charset($link, 'utf8');
if (!isset($_GET['id'])) {
    header("Location:blog.html");
}
$sql = "SELECT * FROM blog WHERE id_blog='" . $_GET["id"] . "'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-83858021-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-83858021-1');
        </script>
        <!-- Global site tag (gtag.js) - Google Ads: 699101810 -->
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'AW-699101810');
            gtag('event', 'conversion', {'send_to': 'AW-699101810/-RWjCP382LEBEPLkrc0C'});
        </script>

        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="content-language" content="en">
        <meta name="robots" content="index, follow, all, noodp, noydir"/>
        <meta name="keywords" content="<?php echo $row['tags']; ?>"/>
        <meta name="author" content="SCORFi3LD">
        <title><?php echo $row['blog_title']; ?> - Lanka Tour Driver</title>

        <meta property="og:title" content="<?php echo $row['blog_title'];?> - Lanka Tour Driver">
        <meta property="og:description" content="<?php echo substr($row['content'], 0, 150);?>">
        <meta property="og:image" content="https://lankatourdriver.com/<?php echo $row['cover_image'];?>">
        <meta property="og:url" content="https://lankatourdriver.com/blog_single.php?id=<?php echo $row['id_blog'];?>">
        <meta property="og:type" content="website" />

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- Fonts -->
        <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" rel="stylesheet" type="text/css"/>
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/animate.css" rel="stylesheet"/>
        <!-- Squad theme CSS -->
        <link href="css/style.css" rel="stylesheet"/>
        <link href="color/default.css" rel="stylesheet"/>
        <!-- whatspp-button CSS -->
        <link href="css/whatspp-button.css" rel="stylesheet" type="text/css"/>

        <link rel='shortcut icon' href='img/favicon.ico' type='image/x-icon' />

        <style type="text/css">
            .meta {
                color: #8f8f8f;
                font-size: 12px;
            }

            .meta span {
                display: inline-block;
            }

            .meta span:after { 
                content: "";
                display: inline-block;
                width: 3px;
                height: 3px;
                border-radius: 50%;
                background:#8f8f8f;
                margin-left: 0.5rem;
                margin-right: 0.5rem;
                position: relative;
                top: -3px
            }

            .meta span:last-child:after {
                display: none;
            }

            .img-responsive {
                width: 100%;
                height: auto;
                margin-bottom: 20px;
            }
        </style>
    </head>

    <body id="page-top" data-spy="scroll" data-target=".navbar-custom">
        <!-- Preloader -->
        <div id="preloader">
            <div id="load"></div>
        </div>

        <div id="nav"></div>

        <!-- Section: intro -->
        <div style="height: 100px;"></div>
        <!-- /Section: intro -->

        <!-- Section: about -->
        <section class="home-section text-center" style="padding-bottom:10px;padding-top:20px;">
            <div class="container">
                <div class="text-left text-justify">
                    <img class="img-responsive" src="<?php echo $row['cover_image']; ?>" alt="<?php echo $row['blog_title']; ?>"/>
                    <h4 class="marginbot-10"><?php echo $row['blog_title']; ?></h4>
                    <?php
                    $now = time();
                    $publishedDate = strtotime($row['published_date']);
                    $elapsedDays = round(($now - $publishedDate) / 86400);
                    ?>
                    <div class="meta"><span>Published <?php echo $elapsedDays; ?> days ago</span></div>
                    <p><?php echo $row['content']; ?></p>

                    <div id="disqus_thread"></div>
                    <script>
                        var disqus_config = function () {
                            // this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                            this.page.identifier = <?php echo $row['id_blog']; ?>;
                        };

                        (function () { // DON'T EDIT BELOW THIS LINE
                            var d = document, s = d.createElement('script');
                            s.src = 'https://lankatourdriver.disqus.com/embed.js';
                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                        })();
                    </script>
                </div>
            </div>
        </section>
        <!-- /Section: about -->

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="wow shake" data-wow-delay="0.4s">
                            <div class="page-scroll marginbot-30">
                                <a href="#page-top" id="totop" class="btn btn-circle">
                                    <i class="fa fa-angle-double-up animated"></i>
                                </a>
                            </div>
                        </div>
                        <p>&copy; Harsha. All rights reserved.</p>
                        <p>Email to us: <a href="mailto:info@lankatourdriver.com?Subject=Hello%20Harsha" target="_top"><strong>info@lankatourdriver.com</strong></a><br></p>
                        <p>Telephone No: <a href="tel:+94777732529" target="_top"><strong>+94 777 732 529</strong></a></p>
                        <ul class="company-social" style="text-align: center">
                            <li class="social-facebook"><a href="https://www.facebook.com/LankaTourDriver/" target="_blank"><i class="fab fa-facebook"></i></a></li>
                            <li class="social-twitter"><a href="https://twitter.com/LankaTourDriver" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li class="social-instagram"><a href="https://www.instagram.com/lanka_tour_driver/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li class="social-tripadvisor"><a href="https://www.tripadvisor.com/Attraction_Review-g7377537-d9851060-Reviews-Lanka_Tour_Driver-Hingurakgoda_North_Central_Province.html" target="_blank"><i class="fab fa-tripadvisor"></i></a></li>
                            <li class="social-whatsapp"><a href="https://api.whatsapp.com/send?phone=94777732529" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                        </ul>

                        <nav class="wb-container visible-xs">
                            <a class="wb-buttons" tooltip="Whatsapp" href="https://api.whatsapp.com/send?phone=94777732529"></a>
                        </nav>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Core JavaScript Files -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.easing.min.js"></script>
        <script src="js/jquery.scrollTo.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/disableClick.js"></script>
        <script id="dsq-count-scr" src="//lankatourdriver.disqus.com/count.js" async></script>
        <!-- Custom Theme JavaScript -->
        <script type="text/javascript">
                        $(document).ready(function () {
                            $('#nav').load("navbar.html");
                        });
        </script>
        <script src="js/custom.js"></script>
    </body>
</html>
