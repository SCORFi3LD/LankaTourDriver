<?php
include '../php/PDBC.php';
mysqli_set_charset($link, 'utf8');
$isEdit = FALSE;
if (isset($_GET["id"])) {
    $isEdit = TRUE;
}
?>

<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <title>Create New Blog</title>
        <meta name="robots" content="noindex"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css"/>
        <link rel="stylesheet" href="css/switch-styles.css" type="text/css"/>
        <link rel="stylesheet" href="css/bootstrap-tagsinput.css" type="text/css"/>
        <style type="text/css">
            .bootstrap-tagsinput {
                display: block;
            }
        </style>
    </head>
    <body>
        <!-- Page Content -->
        <div class="container" style="margin-top: 20px;">
            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <button type="button" class="btn btn-primary" onClick="history.go(-1)">← Back</button>
                    </div>
                    <h1 class="text-center"><?php echo $isEdit ? "Edit Blog Post" : "Create New Blog Post"; ?></h1>
                    <!-- File upload form -->
                    <form action="actions/upload.php" id="uploadForm" method="POST" enctype="multipart/form-data">
                        <?php
                        if (isset($_GET["id"])) {
                            $sql = "SELECT * FROM blog WHERE id_blog='" . $_GET["id"] . "'";
                            $blogResult = mysqli_query($link, $sql);
                            $row = mysqli_fetch_assoc($blogResult);
                            ?>
                            <div class="form-group">
                                <label for="blogTitle">Title</label>
                                <input type="hidden" name="blogId" value="<?php echo $_GET["id"]; ?>"/>
                                <input type="text" class="form-control" name="blogTitle" placeholder="Enter blog title here" value="<?php echo $row["blog_title"]; ?>" required/>
                            </div>
                            <div class="form-group">
                                <label for="blogContent">Text</label>
                                <textarea class="form-control" name="blogContent" rows="10" required><?php echo $row["content"]; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="lang">Select text language</label>
                                <select class="form-control" name="blogLang">
                                    <option value="en" <?php echo $row["lang"] == "en" ? "selected" : ""; ?>>English</option>
                                    <option value="du" <?php echo $row["lang"] == "du" ? "selected" : ""; ?>>Dutch</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tags">Enter tags for blog</label>
                                <input type="text" name="blogTags" value="<?php echo $row["tags"]; ?>" data-role="tagsinput"/>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="form-group">
                                <label for="blogTitle">Title</label>
                                <input type="text" class="form-control" name="blogTitle" placeholder="Enter blog title here" required/>
                            </div>
                            <div class="form-group">
                                <label for="blogContent">Text</label>
                                <textarea class="form-control" name="blogContent" rows="10" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="lang">Select text language</label>
                                <select class="form-control" name="blogLang">
                                    <option value="en">English</option>
                                    <option value="du">Dutch</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tags">Enter tags for blog</label>
                                <input type="text" name="blogTags" data-role="tagsinput"/>
                            </div>
                            <?php
                        }
                        ?>

                        <label>Choose File:</label>
                        <input type="file" name="file" id="fileInput" style="display: inline"/>

                        <!-- Progress bar -->
                        <div class="progress" style="display: none">
                            <div class="progress-bar"></div>
                        </div>
                        <!-- Display upload status -->
                        <div id="uploadStatus" class="text-center" style="margin:10px 0px;"></div>

                        <div style="margin-top: 20px">
                            <button class="btn btn-success btn-block" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/bootstrap-tagsinput.min.js" type="text/javascript">
        </script>
        <script type="text/javascript">
            $('#fileInput').change(function () {
                const fileSize = Math.round(this.files[0].size / 1024);
                if (fileSize >= 1024) {
                    alert("File too Big, please select a file less than 1mb");
                    $(this).val('');
                }
            });

            $(document).ready(function () {

            });
        </script>
    </body>
</html>