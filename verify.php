<?php

$con=mysqli_connect("localhost","digibd_docket","docket","digibd_docket");
//$con=mysqli_connect("localhost","root","","docket");
if($con===false)
{
  echo '<script type= "text/javascript"> alert ("Database Could not connect")</script>';
}

$token = $_GET['token'];

$sql ="SELECT * FROM UserInfo WHERE token = '$token' AND verified = 'no' ";
$query_run = mysqli_query($con,$sql);

if(mysqli_num_rows($query_run) > 0) {
        
    // echo '<script type="text/javascript"> alert("Email Already in USE. Use a different email.")</script>';
    $query = "UPDATE UserInfo SET verified ='yes' WHERE token = '$token' ";
    if(mysqli_query($con,$query)){
        echo "<script> location.href='SignIn.php'; </script>";
    }
    else
    {
        echo '<script type="text/javascript"> alert("Something went wrong.")</script>';
    } 
}   
else {
    echo '<script type="text/javascript"> alert("Invalid Token. Sign Up again.")</script>';
}

?>