 
<?php
	session_start();
	$con=mysqli_connect("localhost","digibd_docket","docket","digibd_docket");
	//$con=mysqli_connect("localhost","root","","docket");
	if($con===false)
	{
	  echo '<script type= "text/javascript"> alert ("Database Could not connect")</script>';
    }
    //echo " aisa porsi mama";
    
    $episodesSeen=$_POST['episodesSeen'];
    $title=$_SESSION['title'];
    $db=$_SESSION['db'];;
    // $rating = $_SESSION['rating'];
    // $type = $_SESSION['type'];
    $episodes = $_SESSION['episodes'];
    // $templink = $_SESSION['templink'];
    
    $sql ="SELECT * FROM {$db} WHERE title = '$title' ";
    $query_run = mysqli_query($con,$sql);
    
    if (mysqli_num_rows($query_run) > 0) {
        
        if($episodesSeen == $episodes)
        {
            $query = "UPDATE {$db} SET episodesSeen = '$episodesSeen', inList = 'Finished' WHERE title = '$title' "; 
        }
        else{
            $query = "UPDATE {$db} SET episodesSeen = '$episodesSeen' WHERE title = '$title' "; 
        }

        if(mysqli_query($con,$query)){
          echo '1';
        }
        else{
          echo '2';
        }         
    }
    else
    {
        echo '3';
    }

?>