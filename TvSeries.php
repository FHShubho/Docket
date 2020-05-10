<!-- Fahimul Hoque Shubho -->
<?php
	//include_once('simple_html_dom.php');
    session_start(); //initializing session
    //connecting to database
	$con=mysqli_connect("localhost","digibd_docket","docket","digibd_docket");
	//$con=mysqli_connect("localhost","root","","docket");
	if($con===false)
	{
	  echo '<script type= "text/javascript"> alert ("Database Could not connect")</script>';
    }

	//session_start();
	$loggedIn = $_SESSION['loggedIn']; //getting the login status

    //Redirecting to login page if user not logged in
	if($loggedIn != 1)
	{
		echo '<script type="text/javascript"> alert ("Please sign in first")</script>';
		echo "<script> location.href='SignIn.php'; </script>";
    }
    // user logged in
	else
	{
    $userID = $_SESSION['userID']; //getting user id from session to retrive additional info from database
    //unset($_SESSION['db']); // clearing the session varble
    $db = $userID.'_TvSeries'; // setting database name to retrive tv series lists
    //$_SESSION['db'] = $db;
?>
<!DOCTYPE html>

<!-- metadata and external resources -->
<head>
	<title>Tv Series</title>
    <link rel='icon' href='favicon.png' type='image/x-icon'/>
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
	<link rel="stylesheet" href="css/plugins.css">
	<link rel="stylesheet" href="css/style_sana.css">
</head>
<body>

<!-- loading banner -->
<div id="preloader">
    <img class="logo" src="images/logo_1.png" alt="Center" >
    <div id="status">
        <span></span>
        <span></span>
    </div>
</div>

<!-- navigation bar -->
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
						<li><a href="blogList.php"><h4>Blogs </h4></a></li>
					</ul>

					<ul class="nav navbar-nav flex-child-menu menu-right">
                        <li><a href="search.php"><img class="logo" src="images/search.png" alt="" width="50" height="50"></a></li>
                        <div class="" title="Go to Profile">
                        <li><a href="UserProfile.php"><img class="logo" src="images/user_1.png" alt="" width="78" height=""></a></li>
                        </div>
					</ul>
				</div>
	    </nav>    
</header>

<!-- heading -->
<div class="hero user-heroFriend">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ctFriends">
                    <img class="logo" src="images/Tlogo.png" alt="" width="50" height=""> 
                    <h1>TvSeries</h1>
				</div>
			</div>
		</div>
    </div>  
</div>

<!-- tv series lists -->
<div class="buster-light">
    <div class="page-single">
	    <div class="container">
            <h4>Watching Now<br></h4>
            <svg height="10" width="500">
                <line x1="0" y1="0" x2="200" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:1"/>
            </svg>
			<div class="flex-wrap-friendlist">   
    
                <?php
                    //retriving watchlist from database
                    $sql = "SELECT title, posterLink FROM {$db} WHERE inList = 'Watching'";
                    $query= mysqli_query($con,$sql);

                    if(mysqli_num_rows($query) > 0 )
                    {
                        $count=mysqli_num_rows($query);
                        $title = array();
                        $poster = array();
                        // storing the series info in arrays from database
                        while($watch = mysqli_fetch_array($query))
                        {
                            $title[] = $watch['title'];
                            $poster[] = $watch['posterLink'];
                        }
                        //print_r($watchList);
                        // loop to display the watchlist
                        for($i=0; $i < $count; $i++)
                        {
                ?>

                <!-- tv series card view -->
                <div class="book-item-style-2 friend-item-style-1">
                    <a href=<?php echo "TvSeriesDetail.php?title=".rawurlencode($title[$i]) ?>> 
                    <img src=<?php echo $poster[$i] ?> alt=""></a>
                    <!-- <h6></h6> -->
                    <?php echo "<h6> $title[$i] </h6>"; ?>
                </div>
                
                <?php        
                    }
                }
                //when no tv series is in this list showing empty placeholder
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
                // retriving wishlist from database
                $sql = "SELECT title, posterLink FROM {$db} WHERE inList = 'Plan to Watch'";
                $query= mysqli_query($con,$sql);
                
                if(mysqli_num_rows($query) > 0 )
                {
                    $count=mysqli_num_rows($query);
                    $title = array();
                    $poster = array();
                    // storing the series info in arrays from database
                    while($watch = mysqli_fetch_array($query))
                    {
                        $title[] = $watch['title'];
                        $poster[] = $watch['posterLink'];
                    }
                    //print_r($poster);
                    // loop to display the watchlist
                    for($i=0; $i < $count; $i++)
                    {
                ?>

                <!-- tv series card view -->
                <div class="book-item-style-2 friend-item-style-1">
                    <a href=<?php echo "TvSeriesDetail.php?title=".rawurlencode($title[$i]) ?>>
                    <img src=<?php echo $poster[$i] ?> alt=""></a>
                    <?php echo "<h6> $title[$i] </h6>"; ?>
                </div>

                <?php        
                    }
                }
                //when no tv series is in this list showing empty placeholder
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
                // retriving finished list from database
                $sql = "SELECT title, posterLink FROM {$db} WHERE inList = 'Finished'";
                $query= mysqli_query($con,$sql);

                if(mysqli_num_rows($query) > 0 )
                {
                    $count=mysqli_num_rows($query);
                    $title = array();
                    $poster = array();
                    //storing the series info in arrays from database
                    while($watch = mysqli_fetch_array($query))
                    {
                        $title[] = $watch['title'];
                        $poster[] = $watch['posterLink'];
                    }
                    //print_r($watchList);
                    // loop to display the finished list
                    for($i=0; $i < $count; $i++)
                    {
                ?>

                <!-- tv series card view -->
                <div class="book-item-style-2 friend-item-style-1">
                    <a href=<?php echo "TvSeriesDetail.php?title=".rawurlencode($title[$i]) ?>>
                    <img src=<?php echo $poster[$i] ?> alt=""></a>
                    <!-- <h6></h6> -->
                    <?php echo "<h6> $title[$i] </h6>"; ?>
                </div>

                <?php        
                    }
                }
                //when no tv series is in this list showing empty placeholder
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


<!-- additional scripts -->
<script src="js/jquery.js"></script>
<script src="js/plugins.js"></script>
<script src="js/plugins2.js"></script>
<script src="js/custom.js"></script>

</body>
</html>
<?php } ?>