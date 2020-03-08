<?php
include_once "Class/class.php";
$shout= new Shout();

 ?>
 <!DOCTYPE html>

<head>
	<title>Landing page</title>

    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
	<link rel="stylesheet" href="css/plugins.css">
	<link rel="stylesheet" href="css/style_Moktadir_khan.css">
</head>


<div id="preloader">
    <img class="logo" src="images/logo_1.png" alt="Center" >

</div>


<header class="ht-header">
	<div class="container">
		<nav class="navbar navbar-default navbar-custom">
				<div class="navbar-header logo">
				    <div class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					    <span class="sr-only">Toggle navigation</span>
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
						<li><a><h4>Anime</h4></a></li>
						<li><a><h4> Movies </h4></a></li>
						<li><a><h4> Tv-Series </h4></a></li>
						<li><a><h4> Games </h4></a></li>
						<li><a><h4> Books </h4></a></li>
						<li><a><h4> Blogs </h4></a></li>
					</ul>

					<ul class="nav navbar-nav flex-child-menu menu-right">
                        <li><a href="UserProfile.html"><img class="logo" src="images/search.png" alt="" width="50" height="50"></a></li>
                        <div class="" title="Go to Profile">
                        <li><a href="UserProfile.html"><img class="logo" src="images/profile.png" alt="" width="78" height=""></a></li>
                        </div>
					</ul>
				</div>
	    </nav>
</header>

<body>
	<div class="shout_container">

	</div>
  <div class="blog_view">


		<div class="col-xs-7 col-sm-6 col-lg-8">
			<div class="blog-item-style-1 blog-item-style-3">
							<img src="images/uploads/bloglist-it1.jpg" alt="">
							<div class="blog-it-infor">
								<h3><a href="blogdetail_light.html">Godzilla: King Of The Monsters Adds O’Shea Jackson Jr</a></h3>
								<span class="time">27 Mar 2017</span>
								<p>Africa's burgeoning animation scene got a boost this week with the announcement of an ambitious new partnership that will pair rising talents from across the continent ...</p>
							</div>
						</div>
						<div class="blog-item-style-1 blog-item-style-3">
							<img src="images/uploads/bloglist-it2.jpg" alt="">
							<div class="blog-it-infor">
								<h3><a href="blogdetail_light.html">Magnolia Nabs ‘Lucky’ Starring Harry Dean Stanton</a></h3>
								<span class="time">27 Mar 2017</span>
								<p>Magnolia Pictures has acquired U.S. and international rights to the comedic drama Lucky John Carroll Lynch’s directorial debut. Lynch is an in-demand character actor who ...</p>
							</div>
						</div>
			<div class="blog-item-style-1 blog-item-style-3">
							<img src="images/uploads/bloglist-it3.jpg" alt="">
							<div class="blog-it-infor">
								<h3><a href="blogdetail_light.html">‘Going in Style’ Tops ‘Smurfs: The Lost Village’ at Thursday Box Office</a></h3>
								<span class="time">27 Mar 2017</span>
								<p>New Line’s remake of “Going in Style” launched with a moderate $600,000 on Thursday night, while Sony’s animated “Smurfs: The Lost Village” debuted with $375,000 ...</p>
							</div>
						</div>
						<div class="blog-item-style-1 blog-item-style-3">
							<img src="images/uploads/bloglist-it4.jpg" alt="">
							<div class="blog-it-infor">
								<h3><a href="blogdetail_light.html">India’s National Film Awards: ‘Kaasav’ Wins Best Picture</a></h3>
								<span class="time">27 Mar 2017</span>
								<p>Although it sporadically errs on the side of sentimentality and simplification, "The Case for Christ" sustains interest, and even generates mild suspense ...</p>
							</div>
						</div>
						<div class="blog-item-style-1 blog-item-style-3">
							<img src="images/uploads/bloglist-it5.jpg" alt="">
							<div class="blog-it-infor">
								<h3><a href="blogdetail_light.html">‘Kong: Skull Island’ Tops $500 Million at Worldwide Box Office</a></h3>
								<span class="time">27 Mar 2017</span>
								<p>King Kong is still a box office giant. “Kong: Skull Island” has crossed the $500 million mark at the worldwide box office. It’s the third 2017 title to hit the milestone after Disney’s ...</p>
							</div>
						</div>
						<div class="blog-item-style-1 blog-item-style-3">
							<img src="images/uploads/bloglist-it6.jpg" alt="">
							<div class="blog-it-infor">
								<h3><a href="blogdetail_light.html">Film Review: ‘Aftermath’</a></h3>
								<span class="time">27 Mar 2017</span>
								<p>"Aftermath" is a plane crash movie without a plane crash. Instead, the closest we get is a scene set in the control tower, where a computer screen shows two ...</p>
							</div>
						</div>
						<ul class="pagination">
							<li class="icon-prev"><a href="#"><i class="ion-ios-arrow-left"></i></a></li>
							<li class="active"><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">...</a></li>
				<li><a href="#">21</a></li>
				<li><a href="#">22</a></li>
				<li class="icon-next"><a href="#"><i class="ion-ios-arrow-right"></i></a></li>
						</ul>
		</div>
	</div>
	<div class="wrapper clr">
	      <header class="headsec clr">

	        <h2>ShoutBox</h2>


	      </header>
	      <section class="content clr">
	        <div class="box">
	          <ul>
	            <?php
	              $getData= $shout->getAllData();
	              if ($getData) {
	                while($data = $getData->fetch_assoc()){ ?>
	                    <li><span><?php echo $data['time']; ?></span>-<b> <?php echo $data['name']; ?></b>: <?php echo $data['body']; ?></li>
	                    <?php

	                }
	              }
	             ?>


	          </ul>
	        </div>
	        <?php
	        if($_SERVER['REQUEST_METHOD']=='POST'){
	          $shoutdata = $shout->insertData($_POST);
	        }
	         ?>
	        <div class="shoutform clr">

	          <form class="shouty"  action="" method="post">
	                <table>
	                  <tr>
	                    <td>Name:</td>
	                    <td><input type="text" name="name" placeholder="please write your name...." required></td>

	                  </tr>
	                  <tr>
	                    <td>Text:</td>
	                    <td><input type="text" name="body" placeholder="please write your text...." required></td>

	                  </tr>
	                  <tr>
	                   <td></td>
	                    <td><input type="submit" value="Shout IT"></td>
	                  </tr>
	                </table>
	          </form>

	        </div>

	      </section>


	    </div>


<script src="js/jquery.js"></script>
<script src="js/plugins.js"></script>
<script src="js/plugins2.js"></script>
<script src="js/custom.js"></script>


</body>
</html>
