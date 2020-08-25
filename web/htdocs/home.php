<?php 
require 'core/init.php';
$general->logged_out_protect();
$username	= htmlentities($account['login']); // storing the user's username after clearning for any html tags.
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/style.css" >
	<title>Welcome <?php echo $username, '!'; ?></title>
</head>
<body>
<div id="header">
</div>	
	<div id="container">
		<?php include 'includes/menu.php'; ?>
		<h2_std>Welcome User... <?php echo $username, '!'; ?></h2_std><br>
		<h2_std>You are successfully logged in!</h2_std><br>
	</div>
</body>
</html>