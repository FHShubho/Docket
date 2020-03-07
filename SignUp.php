<?php
$con=mysqli_connect("localhost","root","","docket");
if($con===false)
{
  echo '<script type= "text/javascript"> alert ("Database Could not connect")</script>';
}
?>
<!DOCTYPE html>

<head>
	<title>Sign Up for Docket</title>
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
	<link rel="stylesheet" href="css/plugins.css">
	<link rel="stylesheet" href="css/style_sana.css">
	</head>

<body>
<div class="loginContainer">
	<div class="headerImage">
		<a href="SignIn.html"><img class="logo" src="images/poster.png" alt="" ></a>
<div class="form1">
    <div class="login-content">
        <h3>Sign Up</h3>
        

        <form method="post" action="">
        	<div class="row">
        		 <label for="username">
                    
                    <input type="text" name="username" id="username" placeholder="Your Name" required/>
                </label>
        	</div>

        	<div class="row">
        		 <label for="Email">
                    
                    <input type="email" name="email" id="email" placeholder="Your E-mail" required/>
                </label>
        	</div>
        	 <div class="row">
            	<label for="password">
                    
                    <input type="password" pattern=".{6,20}" name="pass" id="password" placeholder="Password(6-20charecters)" required/>
                </label>
            </div>

            <div class="row">
            	<label for="password">
                    
                    <input type="password" name="repass" id="password" placeholder="Re-type Password" required/>
                </label>
            </div>
            
           <div class="row">
           	 <button type="submit" name="button">Sign UP</button>
           </div>
        </form>
        <div class="row">

    
			<br>
			<div class="wemail">
				<a href="SignIn.php">Log In</a>
			</div>         	
            </div>
		
    </div>
</div>
</div>
</div>
</body>

<?php
  
if(isset($_POST['button'])){

  $email=$_POST['email'];

  $sql ="SELECT * FROM UserInfo WHERE email = '$email' ";

  $query_run = mysqli_query($con,$sql);

  if (mysqli_num_rows ($query_run) > 0) {
            
    echo '<script type="text/javascript"> alert("Email Already in USE. Use a different email.")</script>';
          
    }
    else {

      if ($_POST['pass'] == $_POST['repass']) {

        $query = "INSERT INTO UserInfo (userName,email,pass) values ('".$_POST['username']."','".$_POST['email']."','".md5($_POST['pass'])."')"; 
      
        if(mysqli_query($con,$query)){
          echo '<script type= "text/javascript"> alert ("signup completed")</script>';
          echo "<script> location.href='SignIn.php'; </script>";
        }
        else{
          echo '<script type= "text/javascript"> alert ("signup error,try again")</script>';
        }
          
      }
      
      else{
        
        echo '<script type ="text/javascript"> alert("Re typed password did not match" )</script>';
       
      }
    }
}

?>
</html>
