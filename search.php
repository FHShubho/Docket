<!-- Fahimul Hoque Shubho -->
<?php
    include_once('simple_html_dom.php');
?>
<!DOCTYPE html>

<head>
	<title>Search</title>

    <link rel='icon' href='favicon.png' type='image/x-icon'/>
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
    <!-- <meta name=viewport content="width=device-width, initial-scale=1"> -->
	<link rel="stylesheet" href="css/plugins.css">
    <link rel="stylesheet" href="css/style_search.css">
    <script>
    var viewMode = getCookie("view-mode");
    if(viewMode == "desktop")
    {
        viewport.setAttribute('content', 'width=1024');
    }
    else if (viewMode == "mobile"){
        viewport.setAttribute('content', 'width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no');
    }
    </script>
 
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
						<li><a href="Anime.php"><h4>Anime</h4></a></li>
						<li><a href="movie.html"><h4> Movies </h4></a></li>
						<li><a href="TvSeries.php"><h4> Tv-Series </h4></a></li>
						<li><a href="games.html"><h4> Games </h4></a></li>
						<li><a href="Books.php"><h4> Books </h4></a></li>
						<li><a href="blogList.html"><h4> Blogs </h4></a></li>
					</ul>
					<ul class="nav navbar-nav flex-child-menu menu-right">
						<li><a href="UserProfile.php"><img class="logo" src="images/profile.png" alt="" width="70" height="70" ></a></li>
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
	<div  class="container">
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
				 <!-- game section -->




               <?php
			   if(isset($_POST['button']) && !empty($_POST['this']))
                    {

                        $s=$_POST['this'];

						$temp1="https://api-v3.igdb.com/games?search=";
						$temp2 = urlencode($s);
						$temp1 .= $temp2;
						$temp1 .= "&fields=cover.url,name,game_modes.slug,genres.name";

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

							// echo "<pre>";
							// print_r ($result);
							 //echo "<pre>";

						}



						?>
				<div class="sectionTitle">
                    <h6><a><span>Games</span></a></h6>
                    <svg height="5" width="900">
                        <line x1="0" y1="0" x2="250" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:1"/>
                    </svg>
                </div>


				<?php	foreach($result as $data){?>
				  <!--image-->
			<?php if(isset ($data['cover'])&& isset ($data['game_modes'])) {?>

			<?php $tmp4=$data['cover']['url'];
					$tmp5 = str_replace('thumb', 'cover_small', $tmp4);

					?>
					  <!--image-->
		       <div class="movie-item-style-2">

		   <img src="<?php echo $tmp5; ?>" >
					<div class="game-item-infor">
			<h6><a href="GameDetail.php?id=<?php  echo $data['id'] ?>"><?php echo $data['name'];?></a></h6>

			<!--game_modes-->
			<?php if(!isset ($data['game_modes']['1']['slug'])){?>

			<p class="rate"></i><span><?php echo "<b>Game mode:</b> ".$data['game_modes']['0']['slug']; ?></span></p>

			<?php } else {?>

				<p class="rate"></i><span><?php echo "<b>Game mode:</b> " .$data['game_modes']['0']['slug'].", ".$data['game_modes']['1']['slug'];?></span></p>  <?php }?>

			<!--game_modes-->
			<!--game_genre-->
				  <?php if(isset ($data['genres']['2']['name'])) {?>
            <p class="rate"></i><span><?php echo "<b>Genre:</b> " .$data['genres']['0']['name'].", ".$data['genres']['1']['name'].", ".$data['genres']['2']['name'];?></span></p>

          <?php } elseif(isset ($data['genres']['1']['name'])) { ?>
            <p class="rate"></i><span><?php echo "<b>Genre:</b> " .$data['genres']['0']['name'].", ".$data['genres']['1']['name'];?></span></p>

          <?php } else { ?>

            <p class="rate"></i><span><?php echo "<b>Genre:</b> ".$data['genres']['0']['name']; ?></span></p>

        	 <?php }?>
        <!--game_genre-->



						</div>
	</div>
	<?php 	} ?>
		<?php
			}
		?>

		<?php 	} ?>
			
<!-- game section ends -->

            <!-- anime section -->
                <?php
                    if(isset($_POST['button']) && !empty($_POST['this']))
                    {
                        $s=$_POST['this'];

                        //$search= "Kimi no Nawa";
                        $search=$s;
                        $search = preg_replace('/\s+/', '%20', $search);

                        $searchTerm='https://myanimelist.net/anime.php?q=';
                        $extension = '&type=0&score=0&status=0&p=0&r=0&sm=0&sd=0&sy=0&em=0&ed=0&ey=0&c%5B%5D=a&c%5B%5D=b&c%5B%5D=c&c%5B%5D=f&gx=0';
                        $searchTerm .= $search;
                        $searchTerm .= $extension;
                        
                    
                        $html = file_get_html($searchTerm);
                        //$html = str_get_html($searchTerm);
                    
                        $posters = array();
                        $b=0;
                        foreach($html->find('img') as $header) 
                        {
                            $posters[] = $header->{'data-src'};
                            $b++;
                            if($b >4)
                            break;
                        }    
                        
                        $b=0;
                        $titles = array();
                        $links = array();
                        foreach($html->find('a[class=hoverinfo_trigger fw-b fl-l]') as $header) {
                            $titles[] = $header->plaintext;
                            $links[] = $header->href;
                            $b++;
                            if($b > 3)
                            break;
                        }
                        
                        $b=0;
                        $details = array();
                        foreach($html->find('td[class=borderClass ac bgColor0]') as $header) {
                            $details[] =$header->plaintext;
                            $b++;
                            if($b > 7)
                            break;
                        }
                        $b=0;
                        $details1 = array();
                        foreach($html->find('td[class=borderClass ac bgColor1]') as $header) {
                            $details1[] =$header->plaintext;
                            $b++;
                            if($b > 7)
                            break;
                        }
                        $html->clear(); 
                        unset($html);
                        ?>
                        <div class="sectionTitle">
                            <h6><a><span>Anime</span></a></h6>
                            <svg height="5" width="900">
                                <line x1="0" y1="0" x2="250" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:1"/>
                            </svg>
                        </div> 

                        <?php        
                        $control=0;
                        //$Tcount=0;
                        $count1=0;
                        $count2=0;
                        //print_r($links);
                        //print_r($details);
                        //print_r($details1);
                        
                        while($control<4){    
                        ?>
                               
                <!-- anime -->
                <div class="movie-item-style-2">           

                    <img data-src="<?php echo $posters[$control+1]?>" alt="" width="70" height="">
					<div class="mv-item-infor">
                    <h6><a href="<?php
                    if($control%2 == 0){ 
                        $indexT=$count1;
                        $indexE=$count1+1;
                        $indexR=$count1+2;
                        echo "AnimeDetail.php?title=$titles[$control]&templink=$links[$control]&rating=$details[$indexR]&type=$details[$indexT]&episodes=$details[$indexE]";
                    }
                    else
                    {
                        $indexT=$count2;
                        $indexE=$count2+1;
                        $indexR=$count2+2;
                        echo "AnimeDetail.php?title=$titles[$control]&templink=$links[$control]&rating=$details1[$indexR]&type=$details1[$indexT]&episodes=$details1[$indexE]";
                    }
                        
                    ?>">
                        <?php echo $titles[$control]?></a></h6>
                        <p class="rate"><i class="ion-android-star"></i><span><?php
                        if($control%2 == 0){
                            echo $details[$count1+2];
                        }
                        else{
                            echo $details1[$count2+2];
                        }
                         ?></span> / 10</p>
                        <!-- <svg height="1" width="500">
                        <line x1="0" y1="0" x2="150" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:0"/>
                        </svg> -->
                        <p>Type: <?php
                        if($control%2 == 0){ 
                        echo $details[$count1];
                        }
                        else{
                            echo $details1[$count2];
                        } 
                        ?></p>
                        <p>Episodes:<?php
                        if($control%2 == 0){
                            echo $details[$count1+1];
                            $count1=$count1+4;
                        }
                        else{
                            echo $details1[$count2+1];
                            $count2=$count2+4;
                        }
                        ?></p><br>
					</div>
                </div>

                
                <?php
                    //$Tcount=$Tcount+4;
                    $control++;
                    }
                //}
                ?>
                <!-- book section -->
                <?php

                        $gd="https://www.goodreads.com/";

                        //$search= "The fault in our stars";
                        $search=$s;
                        $search = preg_replace('/\s+/', '+', $search);

                        $searchTerm="https://www.goodreads.com/search?utf8=%E2%9C%93&query=";
                        $searchTerm .= $search;

                        $html = file_get_html($searchTerm);

                        $covers = array();
                        foreach($html->find('img[class=bookCover]') as $header) 
                        {
                            $covers[] = $header->src;
                        }
                        
                        $titles = array();
                        foreach($html->find('span[itemprop=name]') as $header) {
                            $titles[] = $header->plaintext;
                        }

                        $ratings = array();
                        foreach($html->find('span[class=greyText smallText uitext]') as $header) {
                            $ratings[] =$header->plaintext;
                        }
                        $totalResult = count($ratings)/2;
                ?>

                <div class="sectionTitle">
                    <h3><a><span>Books</span></a></h3>
                    <svg height="5" width="900">
                        <line x1="0" y1="0" x2="250" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:1"/>
                    </svg>
                </div> 

                <?php
                    $control=0;
                    $Tcount=0;
                    while($control<3 && $control < $totalResult){       
                ?>
                
                <!-- first book -->
                <div class="movie-item-style-2">             
                    <?php
                            $temp=explode("&mdash",$ratings[$control],-1);
                            $temp = preg_replace('/\;+/', '', $temp);
                            $temp[0] = preg_replace('/avg rating+/', '', $temp[0]);
                            $temp[2] = preg_replace('/published+/', '', $temp[2]);

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
                        //$html2 = file_get_html($templink);
                        //$plot= $html2->find('div[id=description]', 0);
                        //$plot = preg_replace('/more+/', ' ', $plot);
                        $temp3=$Tcount+1;
                        //$poster = $html2->find('img[id=coverImage]', 0)->src;                        
                    ?>

                    <img data-src="<?php echo $covers[$Tcount]?>" alt="" width="70" height="">
					<div class="mv-item-infor">
                    <h6><a href="<?php echo "BookDetail.php?title=$y&templink=$templink&year=$temp[2]"?>">
                        <?php echo $titles[$Tcount]?> <span>(<?php echo $temp[2] ?>)</span></a></h6>
                        <p class="rate"><i class="ion-android-star"></i><span><?php echo $temp[0]?></span> / 5</p>
                        <!-- <svg height="5" width="500">
                        <line x1="0" y1="0" x2="700" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:1"/>
                        </svg> -->
						<p>Type: Book</p>
						<p class="run-time">Published: <?php echo $temp[2] ?></p>
						<p>Writer: <a href=""><?php echo $titles[$Tcount+1]?></a></p><br>
					</div>
                </div>

                
                <?php

                    $Tcount=$Tcount+2;
                    $control++;
                    }
                    $html->clear(); 
                    unset($html);
                //}
                ?>

                <!-- tv series -->
                <?php
                    //$s = 'game of thrones';
                    $search=$s;
                    $search = preg_replace('/\s+/', '%20', $search);
                    $searchTerm='https://www.imdb.com/find?q=';
                    $extension = '&s=tt&ttype=tv&ref_=fn_tv';
                    $searchTerm .= $search;
                    $searchTerm .= $extension;
        
                    $html = file_get_html($searchTerm);

                    $b=0;
                    $titles = array();
                    foreach($html->find('td[class=result_text]') as $header) {
                        $titles[] = $header->plaintext;
                        $b++;
                        if($b > 3)
                        break;
                    }

                    $b=0;
                    $links = array();
                    foreach($html->find('td[class=result_text] a') as $header) {
                        $links[] = $header->href;
                        $b++;
                        if($b > 3)
                        break;
                    }

                    $b=0;
                    $posters = array();
                    foreach($html->find('td[class=primary_photo] img') as $header) {

                        $posters[] = $header->src;
                        $b++;
                        if($b > 3)
                        break;
                    }
                ?>

                <div class="sectionTitle">
                    <h3><a><span>Tv Series/Tv Movies</span></a></h3>
                    <svg height="5" width="900">
                        <line x1="0" y1="0" x2="250" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:1"/>
                    </svg>
                </div> 

                <?php
                        $control=0;
                        $Tcount=0;
                        while($control<3){
                ?>
                
                <div class="movie-item-style-2">             
                    <?php
                            $temp=explode('(',$titles[$control]);
                            $temp = preg_replace('/\)+/', '', $temp);
                            //$temp[0] = preg_replace('/avg rating+/', '', $temp[0]);
                            //$temp[2] = preg_replace('/published+/', '', $temp[2]);                       
                    ?>

                    <img data-src="<?php echo $posters[$control]?>" alt="" width="70" height="">
					<div class="mv-item-infor">
                    <h6><a href="<?php echo "TvSeriesDetail.php?title=$temp[$control]&templink=$links[$control]&type=$temp[2]&year=$temp[1]"?>">
                        <?php echo $temp[0]?></a></h6>
                        <!-- <p class="rate"><i class="ion-android-star"></i><span></span> / 5</p> -->
                        <!-- <svg height="5" width="500">
                        <line x1="0" y1="0" x2="700" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:1"/>
                        </svg> -->
						<p>Type: <?php echo $temp[2]?></p>
						<p class="run-time">Released: <?php echo $temp[1] ?></p>
					</div>
                </div>

                
                <?php
                    $control++;
                    }
                    $html->clear(); 
                    unset($html);
                //}
                ?>

                





                <?php } ?>
                </div>
				<!-- </div>
				</div> -->
			</div>
		</div>
	</div>
</div>
</div>

        
<script>
    function initLazy() {
        const imgDefer = document.getElementsByTagName("img");
        for (let i =  0; i < imgDefer.length; i++) {
            if (imgDefer[i].getAttribute("data-src")) {
                imgDefer[i].setAttribute("src",imgDefer[i].getAttribute("data-src"));
            } 
        }
    }
    window.addEventListener("DOMContentLoaded", function(event) {
        initLazy();
    });
    
</script>
<script src="js/jquery.js"></script>
<script src="js/plugins.js"></script>
<script src="js/plugins2.js"></script>
<script src="js/custom.js"></script>

</body>
</html>
