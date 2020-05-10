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

	session_start();
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
    //$_SESSION['db'] = $db;
    $blogId = $_GET['blogId']; // receving the blog id to show details
?>

<!DOCTYPE html>

<!-- metadata and external resources -->
<head>
	<title>Blog Detail</title>
	<link rel='icon' href='favicon.png' type='image/x-icon'/>
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
	<link rel="stylesheet" href="css/plugins.css">
	<link rel="stylesheet" href="css/style_sana.css">
</head>
<body>

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
						
						<li><a href="search.php"><img class="logo" src="images/search.png" alt="" width="50" height="50"></a></li>
                        <div class="" title="Go to Profile">
                        <li><a href="UserProfile.php"><img class="logo" src="images/user_1.png" alt="" width="78" height=""></a></li>
                        </div>
					</ul>
				</div>
	    </nav>    
</header>

<!-- headline -->
<div class="hero user-heroBlog">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ct">
                    <img class="logo" src="images/blogs_1.png" alt="" width="50" height=""> 
                    <h1>Blog Detail</h1>
				</div>
			</div>
		</div>
    </div>  
</div>


<div class="buster-light">
    <div class="page-single">
	    <div class="container">
            <div class="row ipad-width2">

                <?php
                    $db="Blogs";
                    //$userID = 15;
                    // fetching similiar blogs from user's list
				    $sql = "SELECT * FROM {$db} WHERE uniqueId='$blogId' ";
                    $query= mysqli_query($con,$sql);

                    if(mysqli_num_rows($query) > 0 )
                    {
                        $info= mysqli_fetch_array($query);

                        $authorId= $info['authorId'];
                        $name = $info['authorName'];
                        $title = $info['blogTitle'];
                        $poster = $info['poster'];
                        $content = $info['blogText'];
                        $blogDate = $info['blogDate'];
                    }
                ?>

                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="">
                        <img class="book-single" src=<?php echo $poster ?> alt="">
                    </div>
                </div>
            
                <div class="col-md-8 col-sm-12 col-xs-12">
				    <div class="movie-single-ct main-content">
						<h1><?php echo $title ?><br></h1>
						<div><br><a classs="light-text">by</a><b> <a href=<?php echo "updateScript/userProfileRedirect.php?profileId=$authorId" ?> ><?php echo $name ?></a></b> 
                            <!-- <span class="time"> <?php //echo date('d-m-Y', strtotime($blogDate)) ?></span> -->
                            <!-- formatting date -->
                            <span class="time"> <?php echo date('d', strtotime($blogDate)).' '.date('F', strtotime($blogDate)).' '.date('Y', strtotime($blogDate)) ?></span> 
                        </div>
						<br>
						<p><?php echo $content ?></p>

                    </div>
                </div>
                
                <script>
                    // script to preventing form resubmission in case of page reload
                    if ( window.history.replaceState ) {
                        window.history.replaceState( null, null, window.location.href );
                    }
                </script>
				
				<div class="blog-detail-ct">
				<div class="comment-form">
					<h4></h4>
					<form method="post" action="#">
						<div class="row">
							<div class="col-md-12">
								<textarea name="comment" id="" placeholder="Write a Comment..."></textarea>
							</div>
						</div>
						<input class="submit" type="submit" name="button" placeholder="submit">
					</form>
                </div>
                
                <?php
    
                    if(isset($_POST['button'])){

                        $comment=$_POST['comment']; // get the comment
                        $userName = $_SESSION['userName'];
                        //$userName = 'Fahimul Hoque';
                        $userPic = $_SESSION['userPic'];
                        //$userPic = 'images/user.png';
                        //echo $comment;
                        //inserting into database
                        $query = "INSERT INTO BlogComment (blogId, authorId, authorName, authorPic, content, cDate) values ('".$blogId."','".$userID."','".$userName."','".$userPic."','".$comment."',now() )";
                        if(mysqli_query($con,$query)){
                            // Do nothing. Reload the page.
                        }
                        else
                        {
                            echo '<script type= "text/javascript"> alert ("Failed to register comment")</script>'; // error message
                        }

                    }
                ?>

				<div class="comments">
                    <?php

                    //retriving comments from database
                    $sql = "SELECT * FROM BlogComment WHERE  blogId = '$blogId' ";
                    $query= mysqli_query($con,$sql);

                    if(mysqli_num_rows($query) > 0 )
                    {
                        $count=mysqli_num_rows($query);
                        $id = array();
                        $cName = array();
                        $cPic = array();
                        $cCommnet = array();
                        $cDate = array();
                        // storing the comment info in arrays from database
                        while($temp = mysqli_fetch_array($query))
                        {
                            $id[] = $temp['authorId'];
                            $cName[] = $temp['authorName'];
                            $cPic[] = $temp['authorPic'];
                            $cComment[] = $temp['content'];
                            $cDate[] = $temp['cDate'];
                        }
                        
                        // loop to display the comments
                        for($i=0; $i < $count; $i++)
                        {
                    
                    ?>
					<div class="cmt-item flex-it">
						<img src="<?php echo $cPic[$i] ?>" alt="" width="50">
						<div class="author-infor" >
							<div class="flex-it2">
                                <h6><a href="<?php echo "updateScript/userProfileRedirect.php?profileId=$id[$i]" ?>"><?php echo $cName[$i] ?></a></h6> 
                                <span class="time"> - <?php echo date('d', strtotime($cDate[$i])).' '.date('F', strtotime($cDate[$i])).' '.date('Y', strtotime($cDate[$i])) ?></span>
							</div>
							<p><?php echo $cComment[$i] ?></p>
						</div>
                    </div>
                    
                    <?php
                        } //end of loop
                    }
                    ?>
	

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