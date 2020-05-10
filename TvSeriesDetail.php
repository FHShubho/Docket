<?php
	include_once('simple_html_dom.php'); //library for web scrapping

	//connectiing database
	$con=mysqli_connect("localhost","digibd_docket","docket","digibd_docket");
	//$con=mysqli_connect("localhost","root","","docket");
	if($con===false)
	{
	  echo '<script type= "text/javascript"> alert ("Database Could not connect")</script>';
	}

	//checking if user is logged in
	session_start();
	$loggedIn = $_SESSION['loggedIn'];

	if($loggedIn != 1)
	{
		echo '<script type="text/javascript"> alert ("Please sign in first")</script>';
		echo "<script> location.href='SignIn.php'; </script>"; //redirecting for logging in
	}
	//user logged in
	else
	{
	$userID = $_SESSION['userID'];
?>

<!DOCTYPE html>

<head>
	<title>Tv Series Detail</title>
	<link rel='icon' href='favicon.png' type='image/x-icon'/> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
	<link rel="stylesheet" href="css/plugins.css">
	<link rel="stylesheet" href="css/style_sana.css">
</head>
<body>

 <!-- loading screen -->
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
						<li><a href="blogList.html"><h4>Blogs </h4></a></li>
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

<!-- tv series details title -->
<div class="hero user-heroFriend">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ctFriends">
                    <img class="logo" src="images/Tlogo.png" alt="" width="50" height=""> 
                    <h1>Tv Series</h1>
				</div>
			</div>
		</div>
    </div>  
</div>

<?php
	//receving title sent from the search page
    $db = $userID.'_TvSeries'; // database for retriving existing information
	$title = $_GET['title'];
    //$title = 'Game of thrones';
    //$link = $_GET['templink'];
    //$link = '/title/tt0944947/?ref_=fn_tv_tt_1';
	
	//checking if it is already in the list
	$sql ="SELECT * FROM {$db} WHERE title = '$title' ";
	$query_run = mysqli_query($con,$sql);
  
	//if it is in the list, retriving additional info from database
	if (mysqli_num_rows($query_run) > 0) 
	{		  
		$result= mysqli_fetch_array($query_run);

		$templink = $result['templink'];
		$givenRating = $result['myRating'];
		$type = $result['type'];
		$year = $result['Ryear'];
		if($givenRating == NUll) // if rating is not given yet, default user rating is set to 0
		{
			$givenRating = 0;
		}
		$seenEpisodes = $result['episodesSeen'];
		if($seenEpisodes == NUll) // if no episode is watched yet, default watched episodes is set to 0
		{
			$seenEpisodes = 0;
		}
		$nameList = $result['inList']; //retriving which list it is in
		$inShelf = $result['shelf']; //retriving if it is in user's collection
	}
	// if it is not in user list, then receiving type, year and description page link to fetch information
	else
	{
		$type = $_GET['type'];
		$year = $_GET['year'];
		$link = $_GET['templink'];
		$templink = 'https://www.imdb.com'; //prefix for the description page from imdb.com
		$templink .= $link; // complete link for description page
		$inShelf = 'Not In Collection';
	}
	
	//scrapping the infromation from imdb description page
    $html = file_get_html($templink); 
    $poster = $html->find('div[class=poster] img',0)->src; //finding tv series poster 
    //$tags = $html->find('div[class=subtext]',0)->plaintext; //finding year and tyype from imdb page
    //$tags=explode('|',$tags); //diving string into type and array
    //$details = explode('(',$tags[2]); /// type[0] and years[1]
    $rating = $html->find('span[itemprop=ratingValue]',0)->plaintext; //finding rating value
	$plot = $html->find('div[class=inline canwrap] p',0)->plaintext; //finding tv series plot
	// finding number of total episodes
    $ep = $html->find('span[class=bp_sub_heading]',0)->plaintext; 
    $episodes = preg_split('/\s+/', $ep);

?>

<!-- tv series details -->
<div class="buster-light">
    <div class="page-single">
	    <div class="container">
            <div class="row ipad-width2">
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="">
                        <img class="book-single" src=<?php echo $poster ?> alt="">
                    </div>
                </div>
            
				<!-- representing the scrapped information -->
                <div class="col-md-8 col-sm-12 col-xs-12">
				    <div class="movie-single-ct main-content">
						<h1 class="book-title"><?php echo $title; ?><br> 
							<span><h1 class="tagline"></h1></span><br>
							<span><?php echo $type ?> &emsp;|&emsp; <?php echo $year ?> &emsp;|&emsp;
							<img src="images/rating.png" width="25px"> <span><?php echo $rating ?></span> /10&emsp;|&emsp;
							<a id="shelf">Not In Collection</a></span></h1><br>		
                        <div class="ratings">
						My Rating <img src="images/rating.png" width="25px"> <span><input type="number" id=""name="myRating" value=<?php echo $givenRating?> min="0" max="10"></span> /10 <input type="submit" class="button" onclick="updateR()" value="Update"> <br>
						Episode Seen <img src="images/timer.png" width="25px"> <span><input type="number" id="" name="episodesSeen" value=<?php echo $seenEpisodes?> min="0" max=<?php echo $episodes[0] ?>></span> /<?php echo $episodes[0] ?> <input type="submit" class="button" onclick="updateE()" value="Update"> <br>
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
						Storyline
						</div>
                        <p><?php echo $plot ?></p>
                        </div>  
					</div>		

					<!-- <h3>Related Review Blogs</h3>
					<svg height="10" width="500">
						<line x1="0" y1="0" x2="250" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:1"/>
					</svg>
					<br>
					<div class="blog-item-style-1 blog-item-style-3">
						<img src="images/Tpic_1.jpg" alt="" width="50" height="150"> 
						<div class="blog-it-infor">
							<h3><a href="">A Masterpiece</a></h3>
							<span class="username">by user35</span>
							<p>I started to follow the manga after watching the anime and quite frankly I don't see where and how the plot of Shingeki no Kyojin can suck, which in my humble opinion is awsome. You can understand the anime very well even without having read the manga. However, SNK isn't understood by many because it's a psychological manga .. SNK isn't just a succession of empty and meaningless clashes and, of uncontrolled violence, stereotyped heroes who fight the bad (like Bleach)....</p>
						</div>
					</div> -->

                </div>
            </div>
	    </div>
    </div>
</div>

<!-- clearing existing session variables and setting new value to session variable to send data to other scripts -->
<?php
	unset($_SESSION['db']);
	unset($_SESSION['title']);
	unset($_SESSION['year']);
	unset($_SESSION['type']);
	unset($_SESSION['episodes']);
	unset($_SESSION['templink']);
	unset($_SESSION['poster']);

	$_SESSION['db'] = $db;
	$_SESSION['title'] = $title;
	$_SESSION['year'] = $year;
	$_SESSION['type'] = $type;
	$_SESSION['episodes'] = $episodes[0];
	$_SESSION['templink'] = $templink;
	$_SESSION['poster'] = $poster;
?>

<script>
	//adding tv series to userlist
	function updateL()
	{
		var inList = $("input[type='radio']:checked").val();
		//alert('ki ache jibone');
		//alert(inList);

		$.ajax({
            url:"updateScript/updateListTvSeries.php", //calling script to update list in database
            method:"POST",
            data:{
            //name:name,
			'inList': inList
            },
			//list update alert depending on database update script
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

	//adding user rating for this tv series
	function updateR()
	{
		var myRating = $("input[name='myRating']").val();
		//alert(myRating);

		$.ajax({
            url:"updateScript/updateRating.php", // calling script to update rating in the database
            method:"POST",
            data:{
            //name:name,
			'myRating': myRating
            },
			//rating update alert depending on database update script
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
				alertify.success('Please Add to a List First'); // user need to add it to a databse before giving it a rating
			   }
            }
        });
		//alertify.success('Rating Updated');
	}

	//adding episodes watched by the user for this tv series
	function updateE()
	{
		var episodesSeen = $("input[name='episodesSeen']").val();
		//alert(episodesSeen);

		$.ajax({
            url:"updateScript/updateEpisode.php", // calling script to update episode in the database
            method:"POST",
            data:{
            //name:name,
			'episodesSeen': episodesSeen
            },
			// alert depending on database update script
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

	//adding or removing this tv series to collection
	function changeShelf()
	{
		var isChecked=document.getElementById("switch").checked;
		if(isChecked) //adding to collection
		{
			var x = "In Collection";
			//document.getElementById("shelf").textContent="In Collection";
			document.getElementById("shelf").textContent=x;

			$.ajax({
            	url:"updateScript/updateShelf.php", // calling script to update collection status in the database
            	method:"POST",
            	data:{
            	//name:name,
				'shelf': x
            },
			// alert depending on database update script
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
		else if(!isChecked) //removing from collection
		{
			//document.getElementById("shelf").textContent="Not In Collection";
			var x = "Not In Collection";
			document.getElementById("shelf").textContent=x;

			$.ajax({
            	url:"updateScript/updateShelf.php", // calling script to update collection status in the database
            	method:"POST",
            	data:{
            	//name:name,
				'shelf': x
            },
			// alert depending on database update script
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

<!-- other scripts -->
<script src="js/jquery.js"></script>
<script src="js/plugins.js"></script>
<script src="js/plugins2.js"></script>
<script src="js/custom.js"></script>

</body>
</html>
<?php } ?>