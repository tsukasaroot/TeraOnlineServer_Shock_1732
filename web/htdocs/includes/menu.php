<ul>
	<a href="index.php" class="css_button" >Home</a>
	<?php 
	if($general->logged_in())
	{
	?>
		<a href="profile.php?username=<?php echo $account['login'];?>" class="css_button">Profile</a>
		<a href="accountlist.php" class="css_button">Accounts</a>
		<a href="playerlist.php" class="css_button">Players</a>
		<a href="logout.php" class="css_button">Log out</a>
	<?php
	}
	else
	{
	?>
		<a href="login.php" class="css_button">Login</a>
		<a href="register.php" class="css_button">Register</a>
	<?php
	}
	?>
</ul>
<hr />