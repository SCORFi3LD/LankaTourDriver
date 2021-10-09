<?php
include '../php/PDBC.php';
mysqli_set_charset($link, 'utf8');
?>

<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <title>Admin Dashboard</title>
        <meta name="robots" content="noindex"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css"/>
        <link rel="stylesheet" href="css/switch-styles.css"/>
    </head>
    <body>
        <!-- Page Content -->
        <div class="container" style="margin-top: 20px;">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-right">
                        <a href="blog_edit.php"><button type="button" class="btn btn-primary">Create New +</button></a>
                    </div>
                    <h1 class="text-center">Blogs</h1>
                    <table id="blog-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Published Date</th>
                                <th>Title</th>
                                <th>Blog Content</th>
                                <th>Image</th>
                                <th>Language</th>
                                <th>IsShowing</th>
                                <th>Config Blog</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM blog ORDER BY id_blog DESC";
                            if ($blogResult = mysqli_query($link, $sql)) {
                                while ($row = mysqli_fetch_row($blogResult)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row[5]; ?></td>
                                        <td><?php echo $row[1]; ?></td>
                                        <td><?php echo substr($row[3], 0, 150); ?>...</td>
                                        <td><a href="../<?php echo $row[4]; ?>" target="_blank"><img class="img-thumbnail" src="../<?php echo $row[4]; ?>" style="width: 60px; height: 60px; object-fit: cover;"/></td>
                                        <td class="text-center"><?php echo $row[6]; ?></td>
                                        <td class="text-center">
                                            <label class="switch">
                                                <input type="checkbox" <?php
                                                if ($row[7] == "0") {
                                                    echo "checked";
                                                }
                                                ?> onchange="changeBlogState(<?php echo $row[0]; ?>,<?php echo $row[7]; ?>)"/>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td class="text-center"><a href="blog_edit.php?id=<?php echo $row[0]; ?>">Edit</a></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /#wrapper -->

        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap.min.js"></script>
        <script>
        </script>
        <script>
            $(document).ready(function () {
                $('#blog-table').DataTable({
                    "order": [[0, "desc"]]
                });
            });

            function changeBlogState(blogID, state) {
                const params = "?id=" + blogID + "&state=" + state;
                $.get("actions/updateBlogState.php" + params, function (res) {
                    console.log(res);
                });
            }
        </script>
    </body>
</html>