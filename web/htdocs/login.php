<?php
require 'core/init.php';
$general->logged_in_protect();

if (empty($_POST) === false) 
{
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	if (empty($username) === true || empty($password) === true) 
	{
		$errors[] = 'Sorry, please input Username and Password.';
	}
	else if ($accounts->username_exists($username) === false) 
	{
		$errors[] = 'Sorry, but this Username doesn\'t exists.';
	} 
	/*else if ($accounts->account_activated($username) === false) 
	{
		$errors[] = 'Sorry, your Account ist not Activated!<br>Please check your E-Mails for an Activation Mail or...<br> <h2_std>
		<a href="confirm-activation.php">Re-Send Activation E-Mail?</a></h2_std> ';
	}*/
	else 
	{
		if (strlen($password) > 32) 
		{
			$errors[] = 'The password should be less than 32 characters, without spacing.';
		}
		$login = $accounts->login($username, $password);
		if ($login === false) 
		{
			$errors[] = 'Sorry, that username/password is invalid';
		}
		else 
		{
			session_regenerate_id(true);// destroying the old session id and creating a new one
			$_SESSION['Id'] =  $login;
			header('Location: home.php');
			exit();
		}
	}
} 
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/style.css" >
	<title>Login</title>
</head>
<body>
<div id="header"></div>

	<div id="container">
		<?php include 'includes/menu.php'; ?>
		<h1>Login Account</h1>

		<?php 
		if(empty($errors) === false)
		{
			echo '<h2_std>' . implode('</h2_std><h2_std>', $errors) . '</h2_std>';	
		}
		?>
		
	<form method="post" action="">
		<input type="text" class="inputs" placeholder="Username" name="username" value="<?php if(isset($_POST['username'])) echo htmlentities($_POST['username']); ?>" /><br>
		<input type="password" class="inputs" placeholder="Password" name="password" /><br>
		<input type="submit" class="css_button" value="Login" name="submit" />
	</form>

	<h2_std><a href="confirm-recover.php">Forgot your Username or Password?</a></h2_std>

	</div>
</body>
</html>