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
	// session_start();
	$loggedIn = $_SESSION['loggedIn'];

	if($loggedIn != 1)
	{
		echo '<script type="text/javascript"> alert ("Please sign in first")</script>';
		echo "<script> location.href='SignIn.php'; </script>";
	}
	else
	{
	$userID = $_SESSION['userID'];
?>
<!DOCTYPE html>

<head>
	<title>Anime Detail</title>
	<link rel='icon' href='favicon.png' type='image/x-icon'/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
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

<?php
    $db = $userID.'_Anime';	
	$title = $_GET['title'];
	$sql ="SELECT * FROM {$db} WHERE title = '$title' ";
	$query_run = mysqli_query($con,$sql);
  
	if (mysqli_num_rows($query_run) > 0) 
	{		  
		$result= mysqli_fetch_array($query_run);
		
		$rating = $result['rating'];
    	$type = $result['type'];
		$episodes = $result['episodes'];
		$templink = $result['templink'];
		$givenRating = $result['myRating'];
		if($givenRating == NUll)
		{
			$givenRating = 0;
		}
		$seenEpisodes = $result['episodesSeen'];
		if($seenEpisodes == NUll)
		{
			$seenEpisodes = 0;
		}
		$nameList = $result['inList'];
		$inShelf = $result['shelf'];
		$inShelf = 'Not In Collection';
	}
	else
	{
		//$title='Kimi ni Todoke';
		$rating = $_GET['rating'];
		$type = $_GET['type'];
		$episodes = $_GET['episodes'];
		$templink = $_GET['templink'];
	}
    //$templink = 'https://myanimelist.net/anime/6045/Kimi_ni_Todoke';
	$html = file_get_html($templink);
	$poster = $html->find('img[itemprop=image]', 0)->{'data-src'};
    $titleEn=$html->find('div[class=spaceit_pad]',0)->plaintext;
    $titleEn=preg_replace("/$title+/", '', $titleEn);
    $titleEn=preg_replace('/English:+/', '', $titleEn);
    $titleEn=preg_replace("/:+/", '', $titleEn);
    $titleEn=trim($titleEn); 
    $plot=$html->find('span[itemprop=description]',0)->plaintext;
?>

<div class="buster-light">
    <div class="page-single">
	    <div class="container">
            <div class="row ipad-width2">
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="">
                        <img class="book-single" src="<?php echo $poster?>" alt="" >
                    </div>
                </div>
            

                <div class="col-md-8 col-sm-12 col-xs-12">
				    <div class="movie-single-ct main-content">
						<h1 class="book-title"><?php echo $title ?><br>
                            <span><h1 class="tagline"><?php echo $titleEn ?></h1></span><br>
							<span>Anime &emsp;|&emsp; <?php echo $type ?> &emsp;|&emsp; 
							<img src="images/rating.png" width="25px"> <span><?php echo $rating ?></span> /10&emsp;|&emsp;
							<a id="shelf">Not In Collection</a></span></h1><br>
								
                        <div class="ratings">	
						My Rating <img src="images/rating.png" width="25px"> <span><input type="number" name="myRating" value=<?php echo $givenRating?> min="0" max='10'></span> /10 <input type="submit" class="button" onclick="updateR()" value="Update"> <br>
						Episode Seen <img src="images/timer.png" width="25px"> <span><input type="number" name="episodesSeen" value=<?php echo $seenEpisodes?> min="0" max=<?php echo $episodes?>></span> /<?php echo $episodes?> <input type="submit" class="button" onclick="updateE()" value="Update"> <br>
						Add to:&nbsp; 
						<label class="radioContainer"> Plan to Watch &nbsp;
							<input type="radio" <?php echo ($nameList=='Plan to Watch')?'checked':'' ?> name="radio" value = 'Plan to Watch'>
							<span class="checkmark"></span>
						</label>
						<label class="radioContainer"> Watching &nbsp;
							<input type="radio" <?php echo ($nameList=='Watching')?'checked':'' ?> name="radio" value = 'Watching'>
							<span class="checkmark"></span>
						</label>
						<label class="radioContainer"> Finished&nbsp;
							<input type="radio" <?php echo ($nameList=='Finished')?'checked':'' ?> name="radio" value = 'Finished'>
							<span class="checkmark"></span>
						</label>
						<input type="submit" class="button" onclick="updateL()" value="Update"> <br>
						
						In Collection &nbsp;
						<div class="cswitch">
							<input type="checkbox" <?php echo ($inShelf=='In Collection')?'checked':'' ?> id="switch" onclick="changeShelf()"/><label for="switch">Toggl</label>
						</div>
						<br><br>

						<div class="description">
						Synopsis
						</div>
                        <p><?php echo $plot ?></p>
                        </div>  
					</div>
					<!-- end of rating and description div -->

					<!-- <h3>Related Review Blogs</h3>
					<svg height="10" width="500">
						<line x1="0" y1="0" x2="250" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:1"/>
					</svg>
					<br>
					<div class="blog-item-style-1 blog-item-style-3">
						<img src="<?php //echo $poster?>" alt="" width="50" height="150"> 
						<div class="blog-it-infor">
							<h3><a href="">A Masterpiece</a></h3>
							<span class="username">by user35</span>
							<p>I started to follow the manga after watching the anime and quite frankly I don't see where and how the plot of Shingeki no Kyojin can suck, which in my humble opinion is awsome. You can understand the anime very well even without having read the manga. However, SNK isn't understood by many because it's a psychological manga .. SNK isn't just a succession of empty and meaningless clashes and, of uncontrolled violence, stereotyped heroes who fight the bad (like Bleach)....</p>
						</div>
					</div>          -->
                </div>                
            </div>
	    </div>
    </div>
</div>

<?php
	unset($_SESSION['db']);
	unset($_SESSION['title']);
	unset($_SESSION['rating']);
	unset($_SESSION['type']);
	unset($_SESSION['episodes']);
	unset($_SESSION['templink']);
	unset($_SESSION['poster']);

	$_SESSION['db'] = $db;
	$_SESSION['title'] = $title;
	$_SESSION['rating'] = $rating;
	$_SESSION['type'] = $type;
	$_SESSION['episodes'] = $episodes;
	$_SESSION['templink'] = $templink;
	$_SESSION['poster'] = $poster;
?>

<script>
	
	function updateL()
	{
		var inList = $("input[type='radio']:checked").val();
		//alert('ki ache jibone');
		//alert(inList);

		$.ajax({
            url:"updateScript/updateListAnime.php",
            method:"POST",
            data:{
            //name:name,
			'inList': inList
            },
            success:function(response){
				if(response == 1)
			   {
				alertify.success('List Updated');
			   }
			   else if(response == 2)
			   {
				alertify.success('Update Failed');
			   }
			   else if(response == 3)
			   {
				alertify.success('List Updated with New Item');
			   }
			   else{
				alertify.success('Select a List First');
			   }
            }
		});
		//alertify.success('List Updated');		
	}

	function updateR()
	{
		var myRating = $("input[name='myRating']").val();
		//alert(myRating);

		$.ajax({
            url:"updateScript/updateRating.php",
            method:"POST",
            data:{
            //name:name,
			'myRating': myRating
            },
            success:function(response){
               if(response == 1)
			   {
				alertify.success('Rating Updated');
			   }
			   else if(response == 2)
			   {
				alertify.success('Update Failed');
			   }
			   else{
				alertify.success('Please Add to a List First');
			   }
            }
        });
		//alertify.success('Rating Updated');
	}

	function updateE()
	{
		var episodesSeen = $("input[name='episodesSeen']").val();
		//alert(episodesSeen);

		$.ajax({
            url:"updateScript/updateEpisode.php",
            method:"POST",
            data:{
            //name:name,
			'episodesSeen': episodesSeen
            },
            success:function(response){
            	if(response == 1)
			   	{
				alertify.success('Episodes Updated');
				}
				else if(response == 2)
			   	{
				alertify.success('Update Failed');
			   	}
			   	else{
				alertify.success('Please Add to a List First');
			   	}
            }
        });		
	}

	function changeShelf()
	{
		var isChecked=document.getElementById("switch").checked;
		if(isChecked)
		{
			var x = "In Collection";
			//document.getElementById("shelf").textContent="In Collection";
			document.getElementById("shelf").textContent=x;

			$.ajax({
            	url:"updateScript/updateShelf.php",
            	method:"POST",
            	data:{
            	//name:name,
				'shelf': x
            },
            success:function(response){
            	if(response == 1)
			   	{
				alertify.success('Added to Collection');
				}
				else if(response == 2)
			   	{
				alertify.success('Update Failed');
			   	}
			   	else{
				alertify.success('Please Add to a List First');
			   	}
            }
        });
		}
		else if(!isChecked)
		{
			//document.getElementById("shelf").textContent="Not In Collection";
			var x = "Not In Collection";
			document.getElementById("shelf").textContent=x;

			$.ajax({
            	url:"updateScript/updateShelf.php",
            	method:"POST",
            	data:{
            	//name:name,
				'shelf': x
            },
            success:function(response){
            	if(response == 1)
			   	{
				alertify.success('Removed From Collection');
				}
				else if(response == 2)
			   	{
				alertify.success('Update Failed');
			   	}
			   	else{
				document.getElementById('switch').checked = false;
				alertify.success('Please Add to a List First');
			   	}
            }
        });
		}
	}

</script>

<script src="js/jquery.js"></script>
<script src="js/plugins.js"></script>
<script src="js/plugins2.js"></script>
<script src="js/custom.js"></script>

</body>
</html>
<?php } ?>