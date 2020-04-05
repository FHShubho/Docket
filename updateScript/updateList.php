 
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

    //echo $episodesSeen;
    //echo $inList;
    
    $sql ="SELECT * FROM {$db} WHERE title = '$title' ";
    $query_run = mysqli_query($con,$sql);
    
    if (mysqli_num_rows($query_run) > 0) {
            
        $query = "UPDATE {$db} SET inList = '$inList' WHERE title = '$title' "; 
      
        if(mysqli_query($con,$query)){
          //ok
        }
        else{
          echo '<script type= "text/javascript"> alert ("Error, List update failed")</script>';
        }         
    }
    else
    {
        $query = "INSERT INTO {$db} (title,rating,type,episodes,templink,inList) values ('".$title."','".$rating."','".$type."','".$episodes."','".$templink."','".$inList."')"; 
      
        if(mysqli_query($con,$query)){
          //ok
          //echo $query;
        }
        else{
          echo '<script type= "text/javascript"> alert ("Error, Data insertion failed")</script>';
        }
    }


?>