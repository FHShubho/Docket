 
<?php
	session_start();
	$con=mysqli_connect("localhost","digibd_docket","docket","digibd_docket");
	//$con=mysqli_connect("localhost","root","","docket");
	if($con===false)
	{
	  echo '<script type= "text/javascript"> alert ("Database Could not connect")</script>';
    }
    //echo " aisa porsi mama";
    
    $inList=$_POST['inList'];
    $title=$_SESSION['title'];
    $db=$_SESSION['db'];;
    $rating = $_SESSION['rating'];
    $type = $_SESSION['type'];
    $episodes = $_SESSION['episodes'];
    $templink = $_SESSION['templink'];
    $poster = $_SESSION['poster'];

    //echo $episodesSeen;
    //echo $inList;
    
    $sql ="SELECT * FROM {$db} WHERE title = '$title' ";
    $query_run = mysqli_query($con,$sql);
    
    if (mysqli_num_rows($query_run) > 0) {
        if($inList == 'Finished')
        {
          $query = "UPDATE {$db} SET inList = '$inList', episodesSeen = '$episodes' WHERE title = '$title' "; 
        }
        else{
          $query = "UPDATE {$db} SET inList = '$inList' WHERE title = '$title' "; 
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
      if($inList == 'Finished')
      {
        $query = "INSERT INTO {$db} (title,rating,type,episodes,templink,inList,episodesSeen,posterLink) values ('".$title."','".$rating."','".$type."','".$episodes."','".$templink."','".$inList."','".$episodes."','".$poster."')"; 
      }
      else{
        $query = "INSERT INTO {$db} (title,rating,type,episodes,templink,inList,posterLink) values ('".$title."','".$rating."','".$type."','".$episodes."','".$templink."','".$inList."','".$poster."')"; 
      }

      if(mysqli_query($con,$query)){
        echo '3';
      }
      else{
      echo '4';
      }
    }


?>