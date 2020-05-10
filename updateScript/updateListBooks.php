 
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
    $db=$_SESSION['db'];;
    $title=$_SESSION['title'];
    $yearR = $_SESSION['yearR'];
    $templink = $_SESSION['templink'];
    $poster = $_SESSION['poster'];

    //echo $episodesSeen;
    //echo $inList;
    
    $sql ="SELECT * FROM {$db} WHERE title = '$title' ";
    $query_run = mysqli_query($con,$sql);
    
    if (mysqli_num_rows($query_run) > 0) {
        
        $query = "UPDATE {$db} SET inList = '$inList' WHERE title = '$title' "; 

        if(mysqli_query($con,$query)){
          echo '1';
        }
        else{
          echo '2';
        }         
    }
    else
    {
        $query = "INSERT INTO {$db} (title,yearR,templink,inList,posterLink) values ('".$title."','".$yearR."','".$templink."','".$inList."','".$poster."')"; 

        if(mysqli_query($con,$query)){
            echo '3';
        }
        else{
        echo '4';
        }
    }
?>