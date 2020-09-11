<?php 
require 'core/init.php';
$general->logged_out_protect();
$accounts 		= $accounts->account_getaccounts();
$accounts_count = count($accounts);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/style.css" >
	<title>Server Accounts</title>
</head>
<body>	
<div id="header"></div>

	<div id="container">
		<?php include 'includes/menu.php';?>
		<h2_std>Total Accounts found: <?php echo $accounts_count; ?></h2_std><br>
		
		<?php 
		foreach ($accounts as $account) 
		{
			$username = htmlentities($account['login']);?>
			<h2_std>User: <a href="profile.php?username=<?php echo $username;?>">	<?php echo $username?></a> 
			last logged in on... <?php echo date('F j, Y', $account['LastOnlineUtc'])?></h2_std><br>
			<?php
		}
		?>
	</div>
</body>
</html>