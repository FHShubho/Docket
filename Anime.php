<!-- Fahimul Hoque Shubho -->
<?php
	include_once('simple_html_dom.php');
	session_start();
	$con=mysqli_connect("localhost","digibd_docket","docket","digibd_docket");
	//$con=mysqli_connect("localhost","root","","docket");
	if($con===false)
	{
	  echo '<script type= "text/javascript"> alert ("Database Could not connect")</script>';
    }
	//session_start();
	$loggedIn = $_SESSION['loggedIn'];

	if($loggedIn != 1)
	{
		echo '<script type="text/javascript"> alert ("Please sign in first")</script>';
		echo "<script> location.href='SignIn.php'; </script>";
	}
	else
	{
    $userID = $_SESSION['userID'];
    unset($_SESSION['db']);
    $db = $userID.'_Anime';
    //$_SESSION['db'] = $db;
?>

<!DOCTYPE html>

<head>
    <title>My Anime</title>
    <link rel='icon' href='favicon.png' type='image/x-icon'/>
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
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
                        <div class="" title="Go to Profile">
                        <li><a href="UserProfile.php"><img class="logo" src="images/profile.png" alt="" width="78" height=""></a></li>
                        </div>
					</ul>
				</div>
	    </nav>    
</header>

<div class="hero user-heroFriend">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ctFriends">
                    <img class="logo" src="images/anime.png" alt="" width="50" height=""> 
                    <h1>Anime</h1>
				</div>
			</div>
		</div>
    </div>  
</div>

<div class="buster-light">
    <div class="page-single">
	    <div class="container">
            <h4>Watching Now<br></h4>
            <svg height="10" width="500">
                <line x1="0" y1="0" x2="200" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:1"/>
            </svg>
			<div class="flex-wrap-friendlist">   
                
                <?php
                $sql = "SELECT title, posterLink FROM {$db} WHERE inList = 'Watching'";
                $query= mysqli_query($con,$sql);

                if(mysqli_num_rows($query) > 0 )
                {
                    $count=mysqli_num_rows($query);
                    $title = array();
                    $poster = array();
                    while($watch = mysqli_fetch_array($query))
                    {
                        $title[] = $watch['title'];
                        $poster[] = $watch['posterLink'];
                    }
                    //print_r($watchList);
                    for($i=0; $i < $count; $i++)
                    {
                ?>

                <div class="book-item-style-2 friend-item-style-1">
                    <a href=<?php echo "AnimeDetail.php?title=".rawurlencode($title[$i]) ?>>
                    <img src=<?php echo $poster[$i] ?> alt=""></a>
                    <!-- <h6></h6> -->
                    <?php echo "<h6> $title[$i] </h6>"; ?>
                </div>

                <?php        
                    }
                }
                else
                {
                ?>

                <div class="book-item-style-2 friend-item-style-1">
                    <img src='images/empty.jpg' alt=""></a>
                </div>

                <?php
                }
                ?>

            </div>	
            
            <br><br><h4>Plan to Watch<br></h4>
            <svg height="10" width="500">
                <line x1="0" y1="0" x2="200" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:1"/>
            </svg>

            <div class="flex-wrap-friendlist">   
    
            <?php
                $sql = "SELECT title, posterLink FROM {$db} WHERE inList = 'Plan to Watch'";
                $query= mysqli_query($con,$sql);
                
                if(mysqli_num_rows($query) > 0 )
                {
                    $count=mysqli_num_rows($query);
                    $title = array();
                    $poster = array();
                    while($watch = mysqli_fetch_array($query))
                    {
                        $title[] = $watch['title'];
                        $poster[] = $watch['posterLink'];
                    }
                    //print_r($poster);
                    for($i=0; $i < $count; $i++)
                    {
                ?>

                <div class="book-item-style-2 friend-item-style-1">
                    <a href=<?php echo "AnimeDetail.php?title=".rawurlencode($title[$i]) ?>>
                    <img src=<?php echo $poster[$i] ?> alt=""></a>
                    <?php echo "<h6> $title[$i] </h6>"; ?>
                </div>

                <?php        
                    }
                }
                else
                {
                ?>

                <div class="book-item-style-2 friend-item-style-1">
                    <img src='images/empty.jpg' alt=""></a>
                </div>

                <?php
                }
                ?>
	
            </div>
            
            <br><br><h4>Finished Watching<br></h4>
            <svg height="10" width="500">
                <line x1="0" y1="0" x2="200" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:1"/>
            </svg>

            <div class="flex-wrap-friendlist">   
            
            <?php
                $sql = "SELECT title, posterLink FROM {$db} WHERE inList = 'Finished'";
                $query= mysqli_query($con,$sql);

                if(mysqli_num_rows($query) > 0 )
                {
                    $count=mysqli_num_rows($query);
                    $title = array();
                    $poster = array();
                    while($watch = mysqli_fetch_array($query))
                    {
                        $title[] = $watch['title'];
                        $poster[] = $watch['posterLink'];
                    }
                    //print_r($watchList);
                    for($i=0; $i < $count; $i++)
                    {
                ?>

                <div class="book-item-style-2 friend-item-style-1">
                    <a href=<?php echo "AnimeDetail.php?title=".rawurlencode($title[$i]) ?>>
                    <img src=<?php echo $poster[$i] ?> alt=""></a>
                    <!-- <h6></h6> -->
                    <?php echo "<h6> $title[$i] </h6>"; ?>
                </div>

                <?php        
                    }
                }
                else
                {
                ?>

                <div class="book-item-style-2 friend-item-style-1">
                    <img src='images/empty.jpg' alt=""></a>
                </div>

                <?php
                }
                ?>
	
            </div>
	    </div>
    </div>
</div>


<script src="js/jquery.js"></script>
<script src="js/plugins.js"></script>
<script src="js/plugins2.js"></script>
<script src="js/custom.js"></script>

</body>
</html>
<?php } ?>