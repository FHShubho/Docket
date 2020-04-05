<?php

    function newUser($userID){
        $con=mysqli_connect("localhost","digibd_docket","docket","digibd_docket");
        //$con=mysqli_connect("localhost","root","","docket");
        if($con===false)
        {
            echo '<script type= "text/javascript"> alert ("Database Could not connect")</script>';
        }
        
        $db1= $userID.'_Anime';
        $db2= $userID.'_Books';
        // $db3= $userID.'_Movies';
        // $db4= $userID.'_TvSeries';
        // $db5= $userID.'_Games';
        // $db6= $userID.'_Blogs';

        $sql1 ="CREATE TABLE {$db1} (uniqueId int AUTO_INCREMENT PRIMARY KEY, title varchar(150), rating int(5), type varchar(25), episodes int(5), templink varchar(250), episodesSeen int(5), inList varchar(30), shelf varchar(30), myRating int(5), posterLink varchar(250) )";
        if(mysqli_query($con,$sql1)){
            //Do nothing
        }
        else{
            echo '<script type="text/javascript"> alert ("Error creating Anime Table")</script>';
        }
        
        $sql2 ="CREATE TABLE {$db2} (uniqueId int AUTO_INCREMENT PRIMARY KEY, title varchar(150), yearR int(5), templink varchar(250), inList varchar(30), shelf varchar(30), myRating int(5), posterLink varchar(250) )";
        if(mysqli_query($con,$sql2)){
            //Do nothing
        }
        else{
            echo '<script type="text/javascript"> alert ("Error creating Books Table")</script>';
        }

        // $sql3 ="CREATE TABLE {$db3} (blogNumber int PRIMARY KEY, blogTitle varchar(150), blogText text, blogPoster varchar(200), blogDate date)";
        // if(mysqli_query($con,$sql3)){
        //     //Do nothing
        // }
        // else{
        //     echo '<script type="text/javascript"> alert ("Error creating Movie Table")</script>';
        // }

        // $sql4 ="CREATE TABLE {$db4} (blogNumber int PRIMARY KEY, blogTitle varchar(150), blogText text, blogPoster varchar(200), blogDate date)";
        // if(mysqli_query($con,$sql4)){
        //     //Do nothing
        // }
        // else{
        //     echo '<script type="text/javascript"> alert ("Error creating TvSeries Table")</script>';
        // }

        // $sql5 ="CREATE TABLE {$db5} (blogNumber int PRIMARY KEY, blogTitle varchar(150), blogText text, blogPoster varchar(200), blogDate date)";
        // if(mysqli_query($con,$sql5)){
        //     //Do nothing
        // }
        // else{
        //     echo '<script type="text/javascript"> alert ("Error creating Game Table")</script>';
        // }

        // $sql6 ="CREATE TABLE {$db6} (blogNumber int PRIMARY KEY, blogTitle varchar(150), blogText text, blogPoster varchar(200), blogDate date)";
        // if(mysqli_query($con,$sql6)){
        //     //Do nothing
        // }
        // else{
        //     echo '<script type="text/javascript"> alert ("Error creating Blogs Table")</script>';
        // }
    }

    //echo 'done';
?>