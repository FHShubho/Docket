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
    // //unset($_SESSION['db']); // clearing the session varble
    // $db = $userID.'_TvSeries'; // setting database name to retrive tv series lists
    //$_SESSION['db'] = $db;
?>
<!DOCTYPE html>

<html lang="en" class="no-js">

<head>

	<title>Blog List</title>
    <link rel='icon' href='favicon.png' type='image/x-icon'/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
	<link rel="stylesheet" href="css/plugins.css">
	<link rel="stylesheet" href="css/style_sana.css">

</head>

<body>

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
				    <a href=""><img class="logo" src="images/logo_1.png" alt="" width="150" height="60"></a>
			    </div>
				
				<div class="collapse navbar-collapse flex-parent" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav flex-child-menu menu-left">
						
						<li class="dropdown first">
							<a href="movie.html"><h4>movies</h4></a>
						</li>
						<li class="dropdown first">
							<a href="TvSeries.php" ><h4>Tv-Series</h4></a>
						</li>
						<li class="dropdown first">
							<a href="Anime.php"><h4>Anime</h4></a>
						</li>
						<li class="dropdown first">
							<a href="Books.php" ><h4>books</h4></a>
						</li>
						<li class="dropdown first">
							<a href="blogList.php"> <h4>Blogs</h4></a>
						</li>
						<li class="dropdown first">
							<a href="games.html"> <h4>games</h4></a>
						</li>
					</ul>
					<ul class="nav navbar-nav flex-child-menu menu-right">
						<li class="dropdown first">
						<a href="blogCreate.html"><img class="logo" src="images/sblogs.png" width="50" height="50" ><h7></h7></a>
						<li><a href="search.php"><img class="logo" src="images/search.png" alt="" width="50" height="50"></a></li>
						</li> 
						<div class="" title="Go to Profile">
							<li><a href="UserProfile.php"><img class="logo" src="images/user_1.png" alt="" width="78" height=""></a></li>
						</div>
					</ul>
				</div>
	    </nav>	    
	</div>
</header>

<!-- heading -->
<div class="hero user-heroBlog">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ct">
					<h1> MY Review Blogs</h1>
					<ul class="breadcumb">		
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- search for blogs -->
<form class="search_blog" action="BlogSearch.php" style="margin:auto;max-width:500px">
    <input type="text" placeholder="Search for Rewview Blogs" name="searchBlog">
    <button type="submit"><i class="fa fa-search"></i></button>
</form>

<!-- blog list -->
<div class="buster-light">
<div class="page-single">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-sm-12 col-xs-12">
                <?php
                $db="Blogs";
                //$userID = 15;
                // fetching blog list from database
				$sql = "SELECT uniqueId, authorName, blogTitle, blogText, poster FROM {$db} WHERE authorId='$userID' ";
                $query= mysqli_query($con,$sql);

                if(mysqli_num_rows($query) > 0 )
                {
                    $count=mysqli_num_rows($query);
                    $blogId= array();
                    $name = array();
                    $title = array();
					$poster = array();
                    $content = array();
                    while($info = mysqli_fetch_array($query))
                    {
                        $blogId= $info['uniqueId'];
                        $name[] = $info['authorName'];
                        $title[] = $info['blogTitle'];
                        $poster[] = $info['poster'];
                        $temp = $info['blogText'];
                        //taking first 180 charecters for preview in the blog list
                        //$temp1=strpos($temp, ' ', 180);
						$content[] = substr($temp,0,300);
                    }
                    //print_r($watchList);
                    // loop to show the list
                    for($i=0; $i < $count; $i++)
                    {
                ?>
                
                <!-- representation of blog list -->
				<div class="blog-item-style-1 blog-item-style-3">
					<img src=<?php echo $poster[$i] ?> alt="" width="150" height="150"> 
            		<div class="blog-it-infor">
            			<h3><a href=<?php echo "BlogDetail.php?blogId=$blogId[$i]" ?>><?php echo $title[$i] ?></a></h3>
            			<span class="username">by <?php echo $name[$i] ?></span>
            			<p><?php echo $content[$i] ?>...</p>
            		</div>
                </div>
                
                <?php        
                    }
                } // end of loop

                // if the list is empty
                else
                {
                ?>
                
                <!-- empty blog list -->
                <div class="sectionTitle" style="margin: auto;padding-top: 20px;padding-bottom: 0px;">
                    <h3><a><span>No Review Blog written yet</span></a></h3>
                </div> 

                <?php
                } 
                ?>
            	
			</div>			
		</div>
	</div>
</div>
</div>
</div>
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
<?php
}
?>