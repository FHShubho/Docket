<?php
$con=mysqli_connect("localhost","digibd_docket","docket","digibd_docket");
//$con=mysqli_connect("localhost","root","","docket");
if($con===false)
{
 echo '<script type= "text/javascript"> alert("Database could not connect")</script>';
}

?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
  <title>Welcome to Docket</title>
  <link rel='icon' href='favicon.png' type='image/x-icon'/>
  <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
  <meta name=viewport content="width=device-width, initial-scale=0">
	<link rel="stylesheet" href="css/plugins.css">
	<link rel="stylesheet" href="css/style_sana.css">
</head>

<body>
<div class="loginContainer">
	<div class="headerImage">
		<a href="SignIn.php"><img class="logo" src="images/poster.png" alt="" ></a>
<div class="form1">
    <div class="login-content">
        <h3>Login</h3>
        <form method="post" >
        	<div class="row">
        		 <label for="username">
                    Email:
                    <input type="email" name="email" id="email" placeholder="Your Email" required/>
                </label>
        	</div>
           
            <div class="row">
            	<label for="password">
                    Password:
                    <input type="password" name="pass" id="pass" placeholder="Your Password" required/>
                </label>
            </div>
            
           <div class="row">
           	 <button type="submit" name="button">Login</button>
           </div>
        </form>
        <div class="row">
        	<p><b>Or with...</b></p>
            <div class="social-btn-2">
            	<a class="fb" href="#"><i class="ion-social-facebook"></i>Facebook</a>
				<a class="tw" href="#"><i class="ion-social-google"></i>Google</a>
            </div>
		</div>
		<div class="row">
			<br>
			<div class="wemail">
				<a href="SignUp.php">Sign Up with email</a>
			</div>
		</div>
    </div>
</div>
</div>
</div>

</body>

<?php

if(isset($_POST['button']))
{
      
  $email = $_POST['email'];
  $password = md5($_POST['pass']);

  $query ="SELECT * FROM UserInfo WHERE email = '$email' AND pass ='$password' ";

  $query_run = mysqli_query($con,$query);

  if (mysqli_num_rows ($query_run) > 0)
  {

    session_start();
    $_SESSION['email'] = $email;

    $sql ="SELECT * FROM UserInfo WHERE verified = 'yes' AND email='$email' ";
    $query_run = mysqli_query($con,$sql);

    if (mysqli_num_rows($query_run) > 0)
    {
      echo "<script> location.href='UserProfile.html'; </script>";
    }
    else
    {
      echo '<script type="text/javascript"> alert ("Please Verify your email")</script>';
    }
  }
  else {
    echo '<script type="text/javascript"> alert ("Invalid Login Info")</script>';
  }

}

?>
</html>