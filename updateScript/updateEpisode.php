 
<?php
  session_start();//intializing session
  
  // connecting to database
	$con=mysqli_connect("localhost","digibd_docket","docket","digibd_docket");
	//$con=mysqli_connect("localhost","root","","docket");
	if($con===false)
	{
	  echo '<script type= "text/javascript"> alert ("Database Could not connect")</script>';
    }
    //echo " aisa porsi mama";
    
    // rececving infromation to update the database
    $episodesSeen=$_POST['episodesSeen'];
    $title=$_SESSION['title'];
    $db=$_SESSION['db'];;
    // $rating = $_SESSION['rating'];
    // $type = $_SESSION['type'];
    $episodes = $_SESSION['episodes'];
    // $templink = $_SESSION['templink'];
    
   
    $sql ="SELECT * FROM {$db} WHERE title = '$title' ";
    $query_run = mysqli_query($con,$sql);
     
    //updating episode info for existing title
    if (mysqli_num_rows($query_run) > 0) {
        
        if($episodesSeen == $episodes) // moving it to finished list when all the episodes have been watched
        {
            $query = "UPDATE {$db} SET episodesSeen = '$episodesSeen', inList = 'Finished' WHERE title = '$title' "; 
        }
        else{
            $query = "UPDATE {$db} SET episodesSeen = '$episodesSeen' WHERE title = '$title' "; 
        }

        //ressponse back to alert update
        if(mysqli_query($con,$query)){
          echo '1'; // database updated successfully 
        }
        else{
          echo '2'; // database update failed
        }         
    }
    else
    {
        echo '3'; // user has not added it to a list yet
    }
?>