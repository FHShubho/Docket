<?php
include_once 'dbh.inc.php';

$title= $_POST['title'];
$blog= $_POST['blog'];


    $sql="INSERT INTO users ( user_title, user_blog) 
    VALUES ( '$title','$blog');";
    $result = mysqli_query($conn, $sql);
    
    header("Location: ../index.php?signup=success");