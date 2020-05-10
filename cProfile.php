<!-- Fahimul Hoque Shubho -->
<?php
    $con=mysqli_connect("localhost","digibd_docket","docket","digibd_docket");
    //$con=mysqli_connect("localhost","root","","docket");
    if($con===false)
    {
      echo '<script type= "text/javascript"> alert ("Database Could not connect")</script>';
    }
    session_start();
	$loggedIn = $_SESSION['loggedIn'];

	if($loggedIn != 1)
	{
		echo '<script type="text/javascript"> alert ("Please sign in first")</script>';
		echo "<script> location.href='SignIn.php'; </script>";
	}
	else
	{
	$userID = $_GET['profileId'];

    $query = "SELECT * FROM UserInfo WHERE uniqueId = '$userID';";
	$query_run = mysqli_query($con,$query);
      
	if (mysqli_num_rows($query_run) > 0) 
	{		  
	  $result= mysqli_fetch_array($query_run);
	  
	  $userName = $result['userName'];
	  $userImageTemp = $result['pictureURL'];
	  if($userImageTemp != NULL)
	  {
		$userImage = $userImageTemp;
	  }
	  else
	  {
		$userImage = "images/user.png";
	  }
	}
	else
	{
	  echo '<script type="text/javascript"> alert ("User Data Not Found")</script>';
	  echo "<script> location.href='SignIn.php'; </script>";
	}
?>
<!DOCTYPE html>

<head>
	<title>User Profile</title>
	<link rel='icon' href='favicon.png' type='image/x-icon'/>
	<link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
	<meta name=viewport content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/alertify.css" />
	<link rel="stylesheet" href="css/plugins.css">
	<link rel="stylesheet" href="css/style_shubho.css">
</head>
<body>

<div id="preloader">
    <img class="logo" src="images/logo_1.png" alt="Center" >
    <div id="status">
        <span></span>
        <span></span>
    </div>
</div>


<header class="ht-header">
	<div class="container">
		<nav class="navbar navbar-default navbar-custom">
				<div class="navbar-header logo">
				    <div class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					    <span class="sr-only"></span>
					    <div id="nav-icon1">
							<span></span>
							<span></span>
							<span></span>
						</div>
				    </div>
				    <a href="UserProfile.html"><img class="logo" src="images/logo_1.png" alt="" width="150" height="60"></a>
				</div>
				
				<div class="collapse navbar-collapse flex-parent" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav flex-child-menu menu-left">
						<li><a href="Anime.php"><h4>Anime</h4></a></li>
						<li><a href="movie.html"><h4> Movies </h4></a></li>
						<li><a href="TvSeries.php"><h4> Tv-Series </h4></a></li>
						<li><a href="games.html"><h4> Games </h4></a></li>
						<li><a href="Books.php"><h4> Books </h4></a></li>
						<li><a href="blogList.html"><h4>Blogs </h4></a></li>
					</ul>

					<ul class="nav navbar-nav flex-child-menu menu-right">
						<li><a href="search.php"><img class="logo" src="images/search.png" alt="" width="50" height="50"></a></li>
						<li><a href="userProfileSettings.php"><img class="logo" src="images/settings.png" alt="" width="50" height="50"></a></li>
					</ul>
				</div>
	    </nav>    
</header>

<div class="hero user-hero">
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<div class="hero-ct">
					<h1><?php echo $userName ?></h1>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="buster-light">
<div class="page-single">
	<div class="container">
		<div class="row ipad-width">
			<div class="col-md-3 col-sm-12 col-xs-12">
				<div class="user-information">
					<div class="user-img">
						<!-- <a href="#"><img src="images/user.png" alt="" width="200"></a> -->
						<a href=""><img src=<?php echo $userImage ?> alt="" width="200"></a>
					</div>

					<div class="user-fav">
						<ul>
							<li>
								<form method="post" action="">
									<button type="submit" name="button" style="border: 0;background: transparent;">
										<img class="logo" src="images/addFriend.png" alt="" width="70" height="" ><br>Add as Friend
									</button>
								</form>
							</li>  
						</ul>
					</div>	
				</div>
			</div>

			<div class="col-md-9 col-sm-12 col-xs-12">
				<div class="form-style-1 user-pro" action="">
						<div class="row">
							<div class="col-md-6 form-it">
								<label><h3>Anime</h3>
									<svg height="10" width="500">
									<line x1="0" y1="0" x2="200" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:1"/>
								  	</svg>
								</label>
								<ul>
									<li><a><img class="logo" src="images/anime.png" alt="" width="25" height="25"> &nbsp 25 anime watched </a></li><br>
									<li><a><img class="logo" src="images/timer.png" alt="" width="25" height="25"> &nbsp 5 anime on hand </a></li>
								</ul>
							</div>

							<div class="col-md-6 form-it">
								<label><h3>Movies</h3>
									<svg height="10" width="500">
									<line x1="0" y1="0" x2="200" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:1"/>
								  	</svg>
								</label>
								<ul>
									<li><a><img class="logo" src="images/Movies.png" alt="" width="30" height="30"> &nbsp 25 movies watched </a></li><br>
									<li><a><img class="logo" src="images/timer.png" alt="" width="25" height="25"> &nbsp 5 movies on hand </a></li>
								</ul>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6 form-it">
								<label><h3>Tv-Series</h3>
									<svg height="10" width="500">
									<line x1="0" y1="0" x2="200" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:1"/>
								  	</svg>
								</label>
								<ul>
									<li><a><img class="logo" src="images/tvSeries.png" alt="" width="25" height="25"> &nbsp 25 tv series watched </a></li><br>
									<li><a><img class="logo" src="images/timer.png" alt="" width="25" height="25"> &nbsp 5 tv series on hand </a></li>
								</ul>
							</div>
							<div class="col-md-6 form-it">
								<label><h3>Games</h3>
									<svg height="10" width="500">
									<line x1="0" y1="0" x2="200" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:1"/>
								  	</svg>
								</label>
								<ul>
									<li><a><img class="logo" src="images/games.png" alt="" width="25" height="30"> &nbsp 25 games watched </a></li><br>
									<li><a><img class="logo" src="images/timer.png" alt="" width="25" height="25"> &nbsp 5 games on hand </a></li>
								</ul>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6 form-it">
								<label><h3>Books</h3>
									<svg height="10" width="500">
									<line x1="0" y1="0" x2="200" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:1"/>
								  	</svg>
								</label>
								<ul>
									<li><a><img class="logo" src="images/books.png" alt="" width="25" height="25"> &nbsp 25 Books read </a></li><br>
									<li><a><img class="logo" src="images/timer.png" alt="" width="25" height="25"> &nbsp 5 are on hand </a></li>
								</ul>
							</div>
							<div class="col-md-6 form-it">
								<label><h3>Review Blogs</h3>
									<svg height="10" width="500">
									<line x1="0" y1="0" x2="200" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:1"/>
								  	</svg>
								</label>
								<ul>
									<li><a><img class="logo" src="images/blogs.png" alt="" width="25" height="25"> &nbsp 25 Blogs Written </a></li><br>
								</ul>
							</div>
						</div>
							
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<?php
	if(isset($_POST['button']))
	{
		$userDB= $_SESSION['userID'];
    	unset($_SESSION['db']);
    	$db = $userDB.'_Friends';
		$query = "INSERT INTO {$db} (friendId,friendName, profilePic) values ('".$userID."','".$userName."','".$userImage."')"; 
		  
		if(mysqli_query($con,$query))
		{
			alertify.success('Friend Added');
			//header("Location:../FriendProfile.php?friendId=$userID");
			echo "<script> location.href='UserProfile.php'; </script>";
		}
		else
		{
			//echo("Error description: " . mysqli_error($con));
			echo '<script type= "text/javascript"> alert ("Error. Try Again Later")</script>';
		}
	}	
?>

<script src="js/jquery.js"></script>
<script src="js/plugins.js"></script>
<script src="js/plugins2.js"></script>
<script src="js/custom.js"></script>

</body>
</html>
<?php } ?>