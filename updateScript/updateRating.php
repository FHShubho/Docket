 
<?php
  session_start(); //intializing session
  //connecting to database
	$con=mysqli_connect("localhost","digibd_docket","docket","digibd_docket");
	//$con=mysqli_connect("localhost","root","","docket");
	if($con===false)
	{
	  echo '<script type= "text/javascript"> alert ("Database Could not connect")</script>';
    }
    //echo " aisa porsi mama";
    
    // rececving infromation to update the database
    $myRating=$_POST['myRating'];
    $title=$_SESSION['title'];
    $db=$_SESSION['db'];;
    // $rating = $_SESSION['rating'];
    // $type = $_SESSION['type'];
    // $episodes = $_SESSION['episodes'];
    // $templink = $_SESSION['templink'];

    //echo $episodesSeen;
    //echo $inList;
    
    //updating rating to existing entry
    $sql ="SELECT * FROM {$db} WHERE title = '$title' ";
    $query_run = mysqli_query($con,$sql);
    
    if (mysqli_num_rows($query_run) > 0) {
            
        $query = "UPDATE {$db} SET myRating = '$myRating' WHERE title = '$title' "; 
      
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
      echo '3'; // this title is not in the databse
        
    }

?>