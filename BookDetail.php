<!-- Fahimul Hoque Shubho -->
<?php
include_once('simple_html_dom.php');
?>
<!DOCTYPE html>

<head>
    <title>Book Detail</title>
	
	
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
						<li><a href="Anime.html"><h4>Anime</h4></a></li>
						<li><a href="movie.html"><h4> Movies </h4></a></li>
						<li><a href="TvSeries.html"><h4> Tv-Series </h4></a></li>
						<li><a href="games.html"><h4> Games </h4></a></li>
						<li><a href="Books.html"><h4> Books </h4></a></li>
						<li><a href="blogList.html"><h4>Blogs </h4></a></li>
					</ul>

					<ul class="nav navbar-nav flex-child-menu menu-right">
                        <li><a href="searchUI.php"><img class="logo" src="images/search.png" alt="" width="50" height="50"></a></li>
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
                    <img class="logo" src="images/books.png" alt="" width="50" height=""> 
                    <h1>Books</h1>
				</div>
			</div>
		</div>
    </div>  
</div>

<?php
    //$poster=$_GET["poster"];
    $title = $_GET["title"];
    //$rating = $_GET["rating"];
    //$writer = $_GET["writer"];
    $year = $_GET["year"];
    $templink = $_GET["templink"];
    $html = file_get_html($templink);
    $plot= $html->find('div[id=description]', 0);
	$plot = preg_replace('/more+/', ' ', $plot);
	// $title= $html->find('h1[id=bookTitle]', 0);
	$poster = $html->find('img[id=coverImage]', 0)->src;
	$rating= $html->find('span[itemprop=ratingValue]', 0);
	$writer= $html->find('span[itemprop=name]', 0);
?>

<div class="buster-light">
    <div class="page-single">
	    <div class="container">
            <div class="row ipad-width2">
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="">
                        <img class="book-single" src="<?php echo $poster ?>" alt="">
                    </div>
                </div>
            

                <div class="col-md-8 col-sm-12 col-xs-12">
				    <div class="movie-single-ct main-content">
                        <h1 class="book-title"> <?php echo $title; ?> <br> <span><?php echo $writer; ?> &emsp;|&emsp; <?php echo $year; ?> &emsp;|&emsp; <img src="images/rating.png" width="25px"> <span><?php echo $rating; ?></span> /5&emsp;|&emsp;<a id="shelf">In BookShelf</a></span></h1><br>
                        <div class="ratings">						
						My Rating <img src="images/rating.png" width="25px"> <span><input type="number" id="" name="" value="8" min="0" max="10"></span> /10 <input type="submit" class="button" value="Update"> <br>
						Add to:&nbsp; 
						<label class="radioContainer"> Want to Read &nbsp;
							<input type="radio" checked="checked" name="radio">
							<span class="checkmark"></span>
						</label>
						<label class="radioContainer"> On Hand &nbsp;
							<input type="radio" name="radio">
							<span class="checkmark"></span>
						</label>
						<label class="radioContainer"> Finished&nbsp;
							<input type="radio" name="radio">
							<span class="checkmark"></span>
						</label>
						<input type="submit" class="button" value="Update"> <br>
						
						Bookshelf &nbsp;
						<div class="cswitch">
							<input type="checkbox" id="switch" checked onclick="changeShelf()"/><label for="switch">Toggl</label>
						</div>
						<br><br>

						<div class="description">
						Summery
						</div>
                        <p><?php echo $plot ?></p>
                        </div>  
					</div>
					<!-- end of rating and description div -->

					<h3>Related Review Blogs</h3>
					<svg height="10" width="500">
						<line x1="0" y1="0" x2="250" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:1"/>
					</svg>
					<br>
					<div class="blog-item-style-1 blog-item-style-3">
						<img src="<?php echo $poster ?>" alt="" width="50" height="150"> 
						<div class="blog-it-infor">
							<h3><a href="">Another good book</a></h3>
							<span class="username">by user35</span>
							<p>I've waited for this particular story for what feels like ages, and words cannot even describe for how grateful I am that it finally exists in my hands. This book continues the wondrous magical world that we all know and love.
								The story starts out at King's Cross with the original trio preparing their school-age children to board the train to start their first year at School with lots of dream and hope...</p>
						</div>
					</div>
                </div>
            </div>
	    </div>
    </div>
</div>


<script>
	function changeShelf()
	{
		var isChecked=document.getElementById("switch").checked;
		if(isChecked)
		{
			document.getElementById("shelf").textContent="In Bookshelf";
		}
		else if(!isChecked)
		{
			document.getElementById("shelf").textContent="Not In Bookshelf";
		}
	}
</script>
<script src="js/jquery.js"></script>
<script src="js/plugins.js"></script>
<script src="js/plugins2.js"></script>
<script src="js/custom.js"></script>

</body>
</html>