 
<?php
  session_start(); //intializing session

  // connecting to database
	$con=mysqli_connect("localhost","digibd_docket","docket","digibd_docket");
	//$con=mysqli_connect("localhost","root","","docket");
	if($con===false)
	{
	  echo '<script type= "text/javascript"> alert ("Database Could not connect")</script>';
    }
    //echo " aisa porsi mama";

    // rececving infromation to update the database
    $inList=$_POST['inList'];
    $title=$_SESSION['title'];
    $db=$_SESSION['db'];;
    $templink = $_SESSION['templink'];
    $poster = $_SESSION['poster'];
    $episodes = $_SESSION['episodes'];
    $type = $_SESSION['type'];
    $year = $_SESSION['year'];

    //echo $episodesSeen;
    //echo $inList;
    
    $sql ="SELECT * FROM {$db} WHERE title = '$title' ";
    $query_run = mysqli_query($con,$sql);
    
    //updating existing tv series
    if (mysqli_num_rows($query_run) > 0) {
        //if it is in finished list, seen episode is set to total number of episodes
        if($inList == 'Finished') 
        {
          $query = "UPDATE {$db} SET inList = '$inList', episodesSeen = '$episodes' WHERE title = '$title' "; 
        }
        // update the tv series in the list
        else{ 
          $query = "UPDATE {$db} SET inList = '$inList' WHERE title = '$title' "; 
        }

        //ressponse back to alert update
        if(mysqli_query($con,$query)){
          echo '1'; // database updated successfully 
        }
        else{
          echo '2'; // database update failed
        }         
    }
    //inserting information for new tv series
    else
    {
      //if it is selected as finished, seen episode is set to total number of episodes
      if($inList == 'Finished') 
      {
        $query = "INSERT INTO {$db} (title,type,Ryear,templink,inList,episodesSeen,posterLink) values ('".$title."','".$type."','".$year."','".$templink."','".$inList."','".$episodes."','".$poster."')";
      }
      //adding the tv series in the list
      else{ 
        $query = "INSERT INTO {$db} (title,type,Ryear,templink,inList,posterLink) values ('".$title."','".$type."','".$year."','".$templink."','".$inList."','".$poster."')"; 
      }

      //ressponse back to alert update
      if(mysqli_query($con,$query)){
        echo '3'; // new entry added to database
      }
      else{
      echo '4'; // adding new entry to database failed
      }
    }
?>