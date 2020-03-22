<?php

include_once 'dbh.inc.php';

if (isset($_POST['submit'])) {

    $title= $_POST['title'];
    $blog= $_POST['blog'];

    $upload_dir= "../public/img/"; // create this folder first in the root directory
    $upload_file= $upload_dir . basename($_FILES['img_url']['name']);
    $db_img_path= "public/img/" . basename($_FILES['img_url']['name']);
    $move_img= move_uploaded_file($_FILES['img_url']['tmp_name'], $upload_file);



    $sql = "INSERT INTO users ( user_title, user_blog, user_image) 
        VALUES ( '$title','$blog','$db_img_path')";

    $result = mysqli_query($conn, $sql);

    if ($result) {

       

    } else {
        echo mysql_error($conn);
    }
}
    