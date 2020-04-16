<?php
    $con=mysqli_connect("localhost","digibd_docket","docket","digibd_docket");
	//$con=mysqli_connect("localhost","root","","docket");
	if($con===false)
	{
	  echo '<script type= "text/javascript"> alert ("Database Could not connect")</script>';
    }
    session_start();
    $userID = $_SESSION['userID'];
    $profileId = $_GET['profileId'];
    $db = $userID.'_Friends';

    $sql = "SELECT friendId FROM {$db} WHERE friendId = '$profileId'";
    $query= mysqli_query($con,$sql);

    if(mysqli_num_rows($query) > 0 )
    {
        header("Location:../FriendProfile.php?friendId=$profileId");
    }
    else
    {
        header("Location:../cProfile.php?profileId=$profileId");
    }
?>