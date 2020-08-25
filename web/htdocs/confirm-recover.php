<?php
require 'core/init.php';
$general->logged_in_protect();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/style.css" >
	<title>Password Recovery</title>
</head>
<body>	
<div id="header"></div>

	<div id="container">
		<?php include 'includes/menu.php'; ?>
		<h1>Password Recovery</h1>
				
		<?php
		if (isset($_GET['success']) === true && empty($_GET['success']) === true) 
		{
			?>	
			<h2_std>Password Recovery done,<br>please check your E-Mail to confirm your request.</h2_std>
			<?php
		} 
		else 
		{
			?>
			<h2_std>Enter your E-Mail below so we can confirm your request.<h2_std>
		    <hr/>
		    <?php
			if (isset($_POST['Email']) === true && empty($_POST['Email']) === false) 
			{
				if ($accounts->email_exists($_POST['Email']) === true)
				{
					$accounts->confirm_password_recovery($_POST['Email']);
					header('Location:confirm-recover.php?success');
					exit();
				} 
				else 
				{
					echo '<h2_hl>Sorry, that E-Mail doesn\'t exist.</h2_hl>';
				}
			}
			?>
			<form action="" method="post">
				<input type="text" class="inputs" placeholder="E-Mail" required name="Email"><br>
				<input type="submit" class="css_button" value="Recover">
			</form>
			<?php	
		}
		?>

	</div>
</body>
</html>