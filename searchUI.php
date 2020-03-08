<!-- Fahimul Hoque Shubho -->
<?php
include_once('simple_html_dom.php');
?>
<!DOCTYPE html>

<head>
	<title>Search</title>

    <link rel='icon' href='favicon.png' type='image/x-icon'/>
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
	<link rel="stylesheet" href="css/plugins.css">
    <link rel="stylesheet" href="css/style_search.css">
 
</head>
<body>

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
						<li><a href="tvseries.html"><h4> Tv-Series </h4></a></li>
						<li><a href="games.html"><h4> Games </h4></a></li>
						<li><a href="books.html"><h4> Books </h4></a></li>
						<li><a href="blogList.html"><h4> Blogs </h4></a></li>
					</ul>
					<ul class="nav navbar-nav flex-child-menu menu-right">
						<li><a href="UserProfile.html"><img class="logo" src="images/profile.png" alt="" width="70" height="70" ></a></li>
					</ul>
				</div>
	    </nav>    
</header>

<div class="hero user-hero">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ct">
                    <h1>Search</h1>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="buster-light">
<div class="page-single">
	<div class="container">
		<div class="row ipad-width">
			<div class="search col-sm-12 col-xs-12">
			<div class="form-style-1 user-pro">
          	<div class="row">
            <div class="col-md-12">
            <div class="sb-example-3">
                <div class="search__container" style="margin:15px">
                <form method="post">    
                    <input type="text" class="search__input" name="this" placeholder="Search for a movie, TV show, games or books that you are looking for"><br>
                    <input type="submit" class="submit" name="button" type="submit" placeholder="search" >
                </form>
                </div>
              </div>
          	</div>
          	</div>
            </div>
            </div>
			<div class="flex-wrap-movielist user-fav-list">
				
            <script>
            if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
            }
            </script>
                <?php
                    if(isset($_POST['button']) && !empty($_POST['this']))
                    {
                        $s=$_POST['this'];
                        
                        $gd="https://www.goodreads.com/";

                        //$search= "The fault in our stars";
                        $search=$s;
                        $search = preg_replace('/\s+/', '+', $search);

                        $searchTerm="https://www.goodreads.com/search?utf8=%E2%9C%93&query=";
                        $searchTerm .= $search;

                        $html = file_get_html($searchTerm);

                        // $covers = array();
                        // foreach($html->find('img[class=bookCover]') as $header) 
                        // {
                        //     $covers[] = $header->src;
                        // }
                        
                        $titles = array();
                        foreach($html->find('span[itemprop=name]') as $header) {
                            $titles[] = $header->plaintext;
                        }

                        $ratings = array();
                        foreach($html->find('span[class=greyText smallText uitext]') as $header) {
                            $ratings[] =$header->plaintext;
                        }
                        $totalResult = count($ratings)/2;
                        $control=0;
                        $Tcount=0;
                        while($control<3 && $control < $totalResult){
                            
                ?>
                
                <!-- first book -->
                <div class="movie-item-style-2">             
                    <?php
                            $temp=explode("&mdash",$ratings[$control],-1);
                            $temp = preg_replace('/\;+/', ' ', $temp);
                            $temp[0] = preg_replace('/avg rating+/', ' ', $temp[0]);
                            $temp[2] = preg_replace('/published+/', ' ', $temp[2]);

                            if(strpos($titles[$Tcount], "(") !== false)
                            {
                                $y=strstr($titles[$Tcount], '(', true);
                            } 
                            else
                            {
                                $y=$titles[$Tcount];
                            }                        
                           
                        $link = array();
                        foreach($html->find("a[title=$y]") as $header) {
                            $link[] =$header->href;
                        } 
                        $templink= $gd;
                        $templink .= $link[0];
                        $html2 = file_get_html($templink);
                        $plot= $html2->find('div[id=description]', 0);
                        $plot = preg_replace('/more+/', ' ', $plot);
                        $temp3=$Tcount+1;
                        $poster = $html2->find('img[id=coverImage]', 0)->src;                        
                    ?>

                    <img src="<?php echo $poster?>" alt="" width="167" height="261">
					<div class="mv-item-infor">
                    <h6><a href="<?php echo "BookDetail.php?title=$y&templink=$templink&year=$temp[2]"?>">
                        <?php echo $titles[$Tcount]?> <span>(<?php echo $temp[2] ?>)</span></a></h6>
                        <p class="rate"><i class="ion-android-star"></i><span><?php echo $temp[0]?></span> / 5</p>
                        <svg height="10" width="500">
                        <line x1="0" y1="0" x2="700" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:1"/>
                        </svg>
						<p class=""><?php echo $plot?></p> <br>
						<p class="run-time">Published: <?php echo $temp[2] ?></p>
						<p>Writer: <a href=""><?php echo $titles[$Tcount+1]?></a></p><br>
					</div>
                </div>

                
                <?php
                    $_SESSION['templink'] = $templink;

                    $Tcount=$Tcount+2;
                    $control++;
                    }
                }
                ?>

                </div>
				<!-- </div>
				</div> -->
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
