<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<?php
include('updateScript/createUser.php');
//require_once "fb_config.php";
$con=mysqli_connect("localhost","digibd_docket","docket","digibd_docket");
//$con=mysqli_connect("localhost","root","","docket");
if($con===false)
{
  echo '<script type= "text/javascript"> alert ("Database Could not connect")</script>';
}

session_start();

$email=$_SESSION['userData']['email'];
$id = $_SESSION['userData']['id'];
$name = $_SESSION['userData']['first_name'];
$name .= " ";
$name .= $_SESSION['userData']['last_name'];
$picture = $_SESSION['userData']['picture']['url'];
//echo $picture;

$sql ="SELECT * FROM UserInfo WHERE fb_id = '$id' ";

$query_run = mysqli_query($con,$sql);

if (mysqli_num_rows ($query_run) > 0) {

  $sql1 ="SELECT * FROM UserInfo WHERE fb_id = '$id' ";
  $query_run = mysqli_query($con,$sql1);
  
  if (mysqli_num_rows($query_run) > 0) 
  {		  
    $result= mysqli_fetch_array($query_run);
    
    $userID = $result['uniqueId'];
    $loggedIn = 1;

    $_SESSION['userID'] = $userID;
    $_SESSION['loggedIn'] = $loggedIn;
  
    echo "<script> alertify.success('Sign In with Facebook Completed'); </script>";
    echo "<script> location.href='UserProfile.php'; </script>";
  }
  else
  {
    echo '<script type="text/javascript"> alert ("Login Error")</script>';
  }  
}
else {
    $sql ="SELECT * FROM UserInfo WHERE email = '$email' ";

    $query_run = mysqli_query($con,$sql);
    
    if (mysqli_num_rows ($query_run) > 0) {
                
      //$query = "UPDATE UserInfo fb_id = '".$id."', verified = 'yes',pictureURL = '".$picture."' WHERE email = '$email' ";
      $query = "UPDATE UserInfo SET fb_id = '$id', verified = 'yes', pictureURL = '$picture' WHERE email = '$email' "; 
      
      if(mysqli_query($con,$query)){

        $sql1 ="SELECT * FROM UserInfo WHERE fb_id = '$id' ";
        $query_run = mysqli_query($con,$sql1);
        
        if (mysqli_num_rows($query_run) > 0) 
        {		  
          $result= mysqli_fetch_array($query_run);
          
          $userID = $result['uniqueId'];
          $loggedIn = 1;
      
          $_SESSION['userID'] = $userID;
          $_SESSION['loggedIn'] = $loggedIn;
        
          echo "<script> alertify.success('Sing In with Facebook Completed'); </script>";
          echo "<script> location.href='UserProfile.php'; </script>";
        }
        else
        {
          echo '<script type="text/javascript"> alert ("Login Error")</script>';
        } 
        //echo "<script> location.href='UserProfile.php'; </script>";
      }
      else{
        echo '<script type= "text/javascript"> alert ("Error 1, try again")</script>';
      }          
    }
    else {
      $query = "INSERT INTO UserInfo (fb_id,userName,email,verified,token,pictureURL) values ('".$id."','".$name."','".$email."','yes','NA','".$picture."')"; 
      
      if(mysqli_query($con,$query)){
        
        $sql1 ="SELECT * FROM UserInfo WHERE fb_id = '$id' ";
        $query_run = mysqli_query($con,$sql1);
        
        if (mysqli_num_rows($query_run) > 0) 
        {		  
          $result= mysqli_fetch_array($query_run);
          
          $userID = $result['uniqueId'];
          $loggedIn = 1;
          newUser($userID);
      
          $_SESSION['userID'] = $userID;
          $_SESSION['loggedIn'] = $loggedIn;
          echo "<script> alertify.success('Sing In with Facebook Completed'); </script>";
          echo "<script> location.href='UserProfile.php'; </script>";
        }
        else
        {
          echo '<script type="text/javascript"> alert ("Login Error")</script>';
        }
      }
      else{
        echo '<script type= "text/javascript"> alert ("Error 2,try again")</script>';
      }
    }
}
//echo $userID;
?>

    
    