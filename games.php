<?php
include_once "Class/class.php";
include_once "lib/Database.php";
$gameswatching= new gameswatching();
$gamesplanned= new gamesplanned();
$gamesfinished= new gamesfinished();
$db= new Database();
 ?><!DOCTYPE html>

<head>
	<title>Games</title>

    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
	<link rel="stylesheet" href="css/plugins.css">
	<link rel="stylesheet" href="css/style_Moktadir_khan.css">
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
				    <a href="UserProfile.php"><img class="logo" src="images/logo_1.png" alt="" width="150" height="60"></a>
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
                        <li><a href="searchUI.php"><img class="logo" src="images/search.png" alt="" width="50" height="50"></a></li>
                        <div class="" title="Go to Profile">
                        <li><a href="UserProfile.php"><img class="logo" src="images/user_1.png" alt="" width="78" height=""></a></li>
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
                    <h1>My Games</h1>
				</div>
			</div>
		</div>
    </div>  
</div>
<div class="space"> </div>
<div class="flex-wrap-movielist mv-grid-fw">
		
			<div class="container">
             <h4>Watching Now<br></h4>
            <svg height="10" width="500">
                <line x1="0" y1="0" x2="200" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:1"/>
            </svg>
			
            <?php
            $per_page= 6;
          	if(isset($_GET["page"])){
          		$page=$_GET ["page"];
            }else{
              $page=1;

            }
          	$start_form =($page-1)* $per_page;

          ?>
<div class="playlist_container">
	
		<?php
    $query = "SELECT * FROM gameswatching LIMIT $start_form, $per_page";
    $post =$db->select($query);
    if($post){
      while ($data=$post->fetch_assoc()) {?>


		<div class="movie-item-style-2 movie-item-style-1">
		
			<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $data['images'] ).'"/>';?>			
				<h6><a href="#"><?php echo $data['names'];?></a></h6>
				</div>
		
		
		<?php
		}
		}
?>
</div>


<?php
 $showData= $gameswatching->showAllData();
 $total_rows=mysqli_num_rows($showData);
 $total_pages=ceil($total_rows/$per_page);?>

<?php
 if($total_pages>1){?>

<?php
 echo "<span class='pagination'><a href='movie.php?page=1'>".'1'."</a>";

 for($i=2;$i<= $total_pages;$i++){
   echo "<a  href='movie.php?page=".$i."'>".$i."</a></span>";
 };

    };
 ?>
	
 

	
			<h4>Planned To Watch<br></h4>
            <svg  height="10" width="500">
                <line x1="0" y1="0" x2="200" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:1"/>
            </svg>

		<div class="playlist_container">
		
		<?php
    $query = "SELECT * FROM gamesplanning LIMIT $start_form, $per_page";
    $post =$db->select($query);
    if($post){
      while ($data=$post->fetch_assoc()) {?>


		<div class="movie-item-style-2 movie-item-style-1">
			<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $data['images'] ).'"/>';?>
				<h6><a href="#"><?php echo $data['name'];?></a></h6>
			
		</div>

		<?php
		}
		}
?>
</div>
<?php
 $showData= $gamesplanned->showAllData();
 $total_rows=mysqli_num_rows($showData);
 $total_pages=ceil($total_rows/$per_page);?>
 
 <?php
 if($total_pages>1){?>

<?php
 echo "<span class='pagination'><a href='movie.php?page=1'>".'1'."</a>";

 for($i=2;$i<= $total_pages;$i++){
   echo "<a  href='movie.php?page=".$i."'>".$i."</a></span>";
 };

    };
 ?>
 
 <div class="space">
 </div>

<h4>Already Watched<br></h4>
            <svg height="10" width="500">
                <line x1="0" y1="0" x2="200" y2="0" style="stroke:rgb(61, 61, 61);stroke-width:1"/>
            </svg>
			<div class="playlist_container">
		
		<?php
    $query = "SELECT * FROM gamesfinished LIMIT $start_form, $per_page";
    $post =$db->select($query);
    if($post){
      while ($data=$post->fetch_assoc()) {?>


		<div class="movie-item-style-2 movie-item-style-1">
			<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $data['images'] ).'"/>';?>
			
				<h6><a href="#"><?php echo $data['name'];?></a></h6>
			
		</div>

		<?php
		}
		}
?>
</div>
<?php
 $showData= $gamesfinished->showAllData();
 $total_rows=mysqli_num_rows($showData);
 $total_pages=ceil($total_rows/$per_page);?>
 
 <?php
 if($total_pages>1){?>

<?php
 echo "<span class='pagination'><a href='movie.php?page=1'>".'1'."</a>";

 for($i=2;$i<= $total_pages;$i++){
   echo "<a  href='movie.php?page=".$i."'>".$i."</a></span>";
 };

    };
 ?>



</div>


<script src="js/jquery.js"></script>
<script src="js/plugins.js"></script>
<script src="js/plugins2.js"></script>
<script src="js/custom.js"></script>
</body>

</html>
