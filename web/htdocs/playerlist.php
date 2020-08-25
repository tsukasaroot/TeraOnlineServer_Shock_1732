<?php 
require 'core/init.php';
$general->logged_out_protect();
$players 			= $players->get_players();
$players_count 	= count($players);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/style.css" >
	<title>Server Players</title>
</head>
<body>	
<div id="header"></div>

	<div id="container">
		<?php include 'includes/menu.php';?>
		<h2_std>Total Players found: <?php echo $players_count; ?></h2_std><br>
		
		<?php 
		foreach ($players as $player) 
		{
			$playername = htmlentities($player['char_name']);
			$playergender = htmlentities($player['sex']);
			$playerrace = htmlentities($player['race_id']);
			$playerclass = htmlentities($player['class_id']);?>
			
			<h2_std>Player: <a href="charprofile.php?playername=<?php echo $playername;?>"><?php echo $playername?></a> 
			Gender: <?php echo $playergender?> ,Race: <?php echo $playerrace?> ,Class: <?php echo $playerclass?> </h2_std><br>
			<?php
		}
		?>
	</div>
</body>
</html>