<?php 
	include 'lib/lib.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Music Viewer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="css/viewer.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div id="header">

			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
		</div>


		<div id="listarea">
			<?php if(isset($_GET['playlist'])):?>
				<h4><a style='margin: 40px;' href='music.php'>Back</a></h4>
				<?php if(isset($_GET['action'])):?>
				<h4><a style='margin: 40px;' href='<? echo $_SERVER['PHP_SELF'],"?playlist=", $_GET['playlist'] ?>&action=shuffle'>Shuffle</a></h4>
				<h4><a style='margin: 40px;' href='<? echo $_SERVER['PHP_SELF'],"?playlist=", $_GET['playlist'] ?>&action=sort'>Sort by size</a></h4>
				<?php 
					else:
				?>
				<h4><a style='margin: 40px;' href='<? echo $_SERVER['REQUEST_URI']?>&action=shuffle'>Shuffle</a></h4>
				<h4><a style='margin: 40px;' href='<? echo $_SERVER['REQUEST_URI']?>&action=sort'>Sort by size</a></h4>
				<?php 
					endif;
				?>
			<?php 
				else:
			?>
				<h4><a style='margin: 40px;' href='<? echo $_SERVER['PHP_SELF'] ?>?action=shuffle'>Shuffle</a></h4>
				<h4><a style='margin: 40px;' href='<? echo $_SERVER['PHP_SELF'] ?>?action=sort'>Sort by size</a></h4>
			<?php 
				endif;
			?>
			<ul id="musiclist">
				<?php
				if(isset($_GET['playlist']))
					list_playlist($_GET['playlist'], $_GET);
				else
					list_all($_GET);
				?>
			</ul>
		</div>
	</body>
</html>