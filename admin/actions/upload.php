<?php

include '../../php/PDBC.php';

$upload = 'err';
if (!empty($_FILES['file'])) {

    // File upload configuration 
    $targetDir = "uploads/";
    $allowTypes = array('jpg', 'png', 'jpeg');

    $fileName = basename($_FILES['file']['name']);
    $targetFilePath = $targetDir . $fileName;

    // Check whether file type is valid 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    if (in_array($fileType, $allowTypes)) {
        
        // Upload file to the server         
        $customFileName = "img/blog/" . time() . "." . $fileType;
        if (move_uploaded_file($_FILES['file']['tmp_name'], "../../" . $customFileName)) {

            if (isset($_POST['blogId'])) { // Update datanase record
                $blogId = $_POST['blogId'];
                $blogTitle = $_POST['blogTitle'];
                $blogTags = $_POST['blogTags'];
                $blogContent = $_POST['blogContent'];
                $blogLang = $_POST['blogLang'];

                $sql = "SELECT * FROM blog WHERE id_blog='" . $blogId . "'";
                $blogResult = mysqli_query($link, $sql);
                $row = mysqli_fetch_assoc($blogResult);
                unlink("../../".$row['cover_image']);

                $updateSql = "UPDATE blog SET blog_title='$blogTitle',tags='$blogTags',content='$blogContent',cover_image='$customFileName',lang='$blogLang' WHERE id_blog='$blogId'";
                mysqli_query($link, $updateSql);

                $upload = 'ok';
            } else { // Add new blog
                $blogTitle = $_POST['blogTitle'];
                $blogTags = $_POST['blogTags'];
                $blogContent = $_POST['blogContent'];
                $blogLang = $_POST['blogLang'];

                // id_blog, blog_title, tags, content, cover_image, published_date, lang, hidden
                $saveSql = "INSERT INTO blog VALUES('0','$blogTitle','$blogTags','$blogContent','$customFileName','" . date("Y-m-d") . "','$blogLang','1')";
                mysqli_query($link, $saveSql);

                $upload = 'ok';
            }
        }
    } else {
        if (isset($_POST['blogId'])) { // Update datanase record
            $blogId = $_POST['blogId'];
            $blogTitle = $_POST['blogTitle'];
            $blogTags = $_POST['blogTags'];
            $blogContent = $_POST['blogContent'];
            $blogLang = $_POST['blogLang'];

            $updateSql = "UPDATE blog SET blog_title='$blogTitle',tags='$blogTags',content='$blogContent',lang='$blogLang' WHERE id_blog='$blogId'";
            mysqli_query($link, $updateSql);

            $upload = 'ok';
        } else {

            $upload = 'err';
        }
    }
}

echo $upload;

header("location: ../index.php");