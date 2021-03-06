<?php
require './includes/config/config.php';

if(isset($_POST['search']))
{
	//Replaces all spaces with + (for search)
	$title = preg_replace("/ /", '+', $_POST['search_field']);
	
	//HTTP request to OMDb API with JSON answer
	$json = file_get_contents("http://www.omdbapi.com/?t=$title&y=&plot=short&r=json&type=movie");
	
	//JSON decode of answer
	$data = json_decode($json, true);
}
?>

<!DOCTYPE html>
<html>
    <head>
		<title>Online Movie Index</title>
		<?php
		require './includes/header.html';
		?>
    </head>
    <body>
		<?php
		require './includes/navbar.php';
		?>
		<div class="container page-wrap">
			<div id="col-lg-12">
            <div class="page-header">
                <h1>Welcome to Online Movie Index</h1>
            </div>
        </div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
				<div class="box">
					<h3>Filters</h3>
					<hr class="header-ender">
					<br>
					<br>
				</div>
			</div>
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
				<div class="col-lg-12">
					<!-- This should be given an javascript function associated, so when a letter is typed, this should invoke a search which toggles images below for results -->
					<form action=" " method="post">
						<input type="text" class="form-control" placeholder="Enter keywords..." name="search_field">
						<input type="submit" name="search" style="display: none">
					</form>
				</div>
				<div class="clearfix"></div>
				<br>
				<div class="col-lg-12">
					<div class="box">
						<h3>Search Result</h3>
						<hr class="header-ender">
						<?php
						if(isset($data))
						{
							if(is_array($data))
							{
								?>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<?php
								foreach($data as $key=>$value)
								{
									if($key == 'Poster')
									{
										//Save Poster URL for later use
										$posterUrl = $value;
									}
									elseif($key == "imdbID")
									{
										//Save ID in IMDb URL to movie
										$imdbLink = "http://www.imdb.com/title/$value/";
										//Print ID
										?>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
								<b><?php echo $key ?>:</b>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
								<?php echo $value ?>
							</div>
							<div class="clearfix"></div>
										<?php
									}
									else
									{
										//Print all values not poster URL or ID
										?>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
								<b><?php echo $key ?>:</b>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
								<?php echo $value ?>
							</div>
							<div class="clearfix"></div>
										<?php
									}
								}
								?>
							<div class="clearfix"></div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<img src="<?php echo $posterUrl ?>">
							<br>
							<br>
							<a href="<?php echo $imdbLink ?>" target="_blank"><img src="http://ia.media-imdb.com/images/G/01/imdb/images/plugins/imdb_46x22-2264473254._CB379390954_.png"></a>
							<div class="clearfix"></div>
						</div>
								<?php

							}
						}
						else
						{
							?>Please search in the field above<?php
						}
						?>
						<div class="clearfix"></div>
					</div>
				</div>
				<br>
				<div class="clearfix"></div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
					<img class="poster" src="http://ia.media-imdb.com/images/M/MV5BMjAzOTM4MzEwNl5BMl5BanBnXkFtZTgwMzU1OTc1MDE@._V1_SX300.jpg">
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
					<img class="poster" src="http://ia.media-imdb.com/images/M/MV5BMTc1Njk1NTE3NF5BMl5BanBnXkFtZTgwNjAyMzcxMTE@._V1_SX300.jpg">
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
					<img class="poster" src="http://ia.media-imdb.com/images/M/MV5BMTY2OTE5MzQ3MV5BMl5BanBnXkFtZTgwMTY2NTYxMTE@._V1_SX300.jpg">
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
					<img class="poster" src="http://ia.media-imdb.com/images/M/MV5BMTMyMTM5OTMxNF5BMl5BanBnXkFtZTYwODcyNDY5._V1_SX300.jpg">
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
					<img class="poster" src="http://ia.media-imdb.com/images/M/MV5BMTQ2MzYwMzk5Ml5BMl5BanBnXkFtZTcwOTI4NzUyMw@@._V1_SX300.jpg">
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
					<img class="poster" src="http://ia.media-imdb.com/images/M/MV5BODU4MjU4NjIwNl5BMl5BanBnXkFtZTgwMDU2MjEyMDE@._V1_SX300.jpg">
				</div>
			</div>
			<div class="clearfix"></div>
			<?php
			require './includes/footer.html';
			?>
		</div>
    </body>
</html>
