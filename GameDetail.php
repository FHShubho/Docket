
<!DOCTYPE html>

<head>
	<title>Game Detail</title>
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
	<link rel="stylesheet" href="css/plugins.css">
	<link rel="stylesheet" href="css/style_Moktadir_khan.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
						<li><a href="movie.php"><h4> Movies </h4></a></li>
						<li><a href="TvSeries.php"><h4> Tv-Series </h4></a></li>
						<li><a href="games.php"><h4> Games </h4></a></li>
						<li><a href="Books.php"><h4> Books </h4></a></li>
						<li><a href="blogList.php"><h4>Blogs </h4></a></li>
					</ul>
					<ul class="nav navbar-nav flex-child-menu menu-right">
                        <li><a href="search.php"><img class="logo" src="images/search.png" alt="" width="50" height="50"></a></li>
                        <div class="" title="Go to Profile">
                        <li><a href="UserProfile.html"><img class="logo" src="images/profile.png" alt="" width="78" height=""></a></li>
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
                    <img class="logo" src="images/games.png" alt="" width="50" height="">
                    <h1>Game</h1>
				</div>
			</div>
		</div>
    </div>
</div>
<?php
if (isset($_GET['id'])) {
	$temp1="https://api-v3.igdb.com/games?fields=cover.url,name,screenshots.url,game_modes.slug,summary,genres.name,videos.*%3Bwhere%20id%3D";
	$temp2 =$_GET['id'];
	$temp1 .= $temp2;
	$temp1 .= "%3B";

	$curl = curl_init();

	curl_setopt_array($curl, array(

		CURLOPT_URL => $temp1,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_POSTFIELDS => "",
		CURLOPT_COOKIE => "__cfduid=d6aa6f76572874d2cffd14a1ce2b8fb7b1586267658",
		CURLOPT_HTTPHEADER => array(
		"accept: application/json",
		"user-key: 13dff6e72667329afab6ecb9b5c49ae6"
		),
	));
	$response=array();
	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		$result =json_decode($response,true);

					//	echo "<pre>";
						//print_r ($result);
						//echo "<pre>";

	}
}


?>
<?php	foreach($result as $data){?>

	<?php $tmp4=$data['cover']['url'];
			$tmp5 = str_replace('thumb', 'cover_big', $tmp4);

			?>


<div class="buster-light">
    <div class="page-single">
	    <div class="container">
            <div class="row ipad-width2">
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="">
                        <img class="book-single" src="<?php echo $tmp5 ; ?>" alt="">
                    </div>
                </div>


                <div class="col-md-8 col-sm-12 col-xs-12">
				    <div class="movie-single-ct main-content">


                        <h1 class="book-title"><?php echo $data['name']; ?><br> <span>Game &emsp;|&emsp; <img src="images/rating.png" width="25px"> <span>8.1</span> /10&emsp;|&emsp;<a id="shelf">In Collection</a></span></h1><br>
                        <div class="ratings">
													<?php if(!isset ($data['game_modes']['1']['slug'])){?>

													<p class="radioContainer"></i><span><?php echo "<br><b>Game mode:</b> ".$data['game_modes']['0']['slug']; ?></span></p>

													<?php } else {?>

														<p class="radioContainer"></i><span><?php echo "<br><b>Game mode:</b> " .$data['game_modes']['0']['slug'].", ".$data['game_modes']['1']['slug'];?></span></p>  <?php }?>

						<!--<label class="radioContainer"><p>Game Mode:  Multiplayer,Singleplayer</p></label>-->
						<?php if(isset ($data['genres']['2']['name'])) {?>
							<p class="radioContainer"></i><span><?php echo "<br><b>Genre:</b> " .$data['genres']['0']['name'].", ".$data['genres']['1']['name'].", ".$data['genres']['2']['name'];?></span></p>

						<?php } elseif(isset ($data['genres']['1']['name'])) { ?>
							<p class="radioContainer"></i><span><?php echo "<br><b>Genre:</b> " .$data['genres']['0']['name'].", ".$data['genres']['1']['name'];?></span></p>

						<?php } else { ?>

							<p class="radioContainer"></i><span><?php echo "<br><b>Genre:</b> ".$data['genres']['0']['name']; ?></span></p>

						 <?php }?>
						<!---	<label class="radioContainer"><p>Genre:  shooter,strategy</p></label>-->
					<br><br>	My Rating <img src="images/rating.png" width="25px"> <span><input type="number" id="" name="" value="8" min="0" max="10"></span> /10 <input type="submit" class="button" value="Update"> <br>
						Add to:&nbsp;
						<label class="radioContainer"> Plan to Play &nbsp;
							<input type="radio" checked="checked" name="radio">
							<span class="checkmark"></span>
						</label>
						<label class="radioContainer"> Playing &nbsp;
							<input type="radio" name="radio">
							<span class="checkmark"></span>
						</label>
						<label class="radioContainer"> Finished&nbsp;
							<input type="radio" name="radio">
							<span class="checkmark"></span>
						</label>
						<input type="submit" class="button" value="Update"> <br>

						In Collection &nbsp;
						<div class="cswitch">
							<input type="checkbox" id="switch" checked onclick="changeShelf()"/><label for="switch">Toggl</label>
						</div>
						<br><br>

						<div class="description">
						Plot
						</div>
                        <p><?php echo $data['summary'];?>
						</p>
                        </div>
					</div>
					</div>
					<!-- end of rating and description div -->
					<!-- Wrapper for slides -->
					<?php $tmp6=$data['videos']['0']['video_id'];
					$tmp7="https://www.youtube.com/embed/";
					$tmp7.=$tmp6;
					$tmp7.="?autoplay=1&mute=1"


						?>
					<br>
					<div class="iframe">


						<iframe width="569" height="315"
						src=<?php echo $tmp7 ;?>
						frameborder="0" allowfullscreen>

						</iframe>
							</div>

						<?php $tmp12=$data['screenshots']['0']['url'];
					 		 $tmp3 = str_replace('thumb', 'screenshot_med', $tmp12);

					 		 ?>
							 <?php $tmp8=$data['screenshots']['1']['url'];
	 					 		 $tmp9 = str_replace('thumb', 'screenshot_med', $tmp8);

	 					 		 ?>
								 <?php $tmp10=$data['screenshots']['2']['url'];
		 					 		 $tmp11 = str_replace('thumb', 'screenshot_med', $tmp10);

		 					 		 ?>


						<div class="slider">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1"></li>
		<li data-target="#myCarousel" data-slide-to="2"></li>
	</ol>

	<!-- Wrapper for slides -->
	<div class="carousel-inner">
		<div class="item active">
			<image	src="<?php echo $tmp3 ;?>" style="width:100%;">
		</div>

		<div class="item">
			<img src="<?php echo $tmp9 ?>"  style="width:100%;">
		</div>

		<div class="item">
			<img src="<?php echo $tmp11 ?>"  style="width:100%;">
		</div>
	</div>

	<!-- Left and right controls -->
	<a class="left carousel-control" href="#myCarousel" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#myCarousel" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right"></span>
		<span class="sr-only">Next</span>
	</a>
</div>
</div>


										<h3>Related Review Blogs</h3>
										<svg height="10" width="500">
											<line x1="0" y1="0" x2="250" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:1"/>
										</svg>
										<br>
										<div class="blog-item-style-1 blog-item-style-3">
											<img src="images/game_1.jpg" alt="" width="50" height="150">
											<div class="blog-it-infor">
												<h3><a href="">Witcher - Another Epic Game</a></h3>
												<span class="username">by user35</span>
												<p>I've waited for this particular story for what feels like ages, and words cannot even describe for how grateful I am that it finally exists in my hands. Harry Potter and the Cursed Child continues the wondrous magical world that we all know and love.
													The story starts out at King's Cross with the original trio preparing their school-age children to board the train to start their first year at Hogwarts School of Witchcraft and Wizardry...</p>
											</div>
										</div>

</div>

                </div>
            </div>
	    </div>
    </div>
</div>


<?php
	}
?>



<script>
	function changeShelf()
	{
		var isChecked=document.getElementById("switch").checked;
		if(isChecked)
		{
			document.getElementById("shelf").textContent="In Collection";
		}
		else if(!isChecked)
		{
			document.getElementById("shelf").textContent="Not In Collection";
		}
	}
</script>
<script src="js/jquery.js"></script>
<script src="js/plugins.js"></script>
<script src="js/plugins2.js"></script>
<script src="js/custom.js"></script>

</body>
</html>
