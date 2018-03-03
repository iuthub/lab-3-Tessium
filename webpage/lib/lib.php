<?php

function get_file_size($size)
{
	if ($size >= 1048576)
  {
      return number_format($size / 1048576, 2) . ' MB';
  }
  elseif ($size >= 1024)
  {
      return number_format($size / 1024, 2) . ' KB';
  }
  elseif ($size > 1)
  {
      return $size . ' bytes';
  }
}

function list_all($get)
{
	$folder = glob("songs/*");

	$temp = $folder;

	if(isset($get['action']) && $get['action']=="shuffle")
		shuffle($folder);

	if(isset($get['action']) && $get['action']=="sort")
	{
		$sorted_folder = [];
		$songs = glob("songs/*.mp3");
		foreach($songs as $file)
		{
			$name = basename($file);
			$size = filesize($file);
			$sorted_folder[$size] = $name;
		}
		krsort($sorted_folder);
		foreach ($sorted_folder as $key => $value) {
			echo "<li class='mp3item'>
				<a href='{$file}'>{$value}</a>
				".get_file_size($key)."
			</li>";
		}
	}
	else
	{
		foreach($folder as $file)
		{
			$name = basename($file);
			$extension = pathinfo($file, PATHINFO_EXTENSION);

			if($extension == 'mp3')
				echo "<li class='mp3item'>
					<a href='{$file}'>{$name}</a>
					".get_file_size(filesize($file))."
				</li>";
		}
	}
	echo "<hr><h3>Playlists</h3>";

	foreach($temp as $file)
	{
		$name = basename($file);
		$extension = pathinfo($file, PATHINFO_EXTENSION);
		if($extension == 'txt' || $extension == 'm3u')
			echo  "<li class='playlistitem'>
								<a href='music.php?playlist={$name}'>{$name}</a>
						</li>";
	}
}

function list_playlist($playlist, $get)
{
	$playlist_name = pathinfo($playlist)['filename'];
	echo "<h3>Playlist: {$playlist_name}</h3>";
	$playlist = file("songs/".$playlist, FILE_IGNORE_NEW_LINES);

	if(isset($get['action']) && $get['action']=="shuffle")
		shuffle($playlist);
	if(isset($get['action']) && $get['action']=="sort")
	{
		$sorted_folder = [];
		foreach($playlist as $file)
		{
			if($file[0]!='#')
			{
				$name = basename($file);
				$size = filesize("songs/".$file);
				$sorted_folder[$size] = $name;
			}
		}
		krsort($sorted_folder);
		foreach ($sorted_folder as $key => $value) {
			echo "<li class='mp3item'>
				<a href='{$file}'>{$value}</a>
				".get_file_size($key)."
			</li>";
		}
		return;
	}

	foreach($playlist as $file)
	{
		$name = basename($file);

		if(in_array($name, $playlist) || in_array($name, $playlist))
			if($name[0]!='#')
				echo "<li class='mp3item'>
					<a href='{$file}'>{$name}</a>
					".get_file_size(filesize("songs/".$file))."
				</li>";
	}
}

?>