<?php 
require 'core/init.php';
$general->logged_in_protect();

if (isset($_POST['submit'])) 
{
	if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['re-password']) || empty($_POST['re-email']))
	{
		$errors[] = 'Missing some data...';
	}
	if(empty($_POST['username']))
	{
		$errors[] = '<br>-Username not found!';
	}
	if(empty($_POST['password']))
	{
		$errors[] = '<br>-Password not found!';
	}
	if(empty($_POST['re-password']))
	{
		$errors[] = '<br>-Password Check not found!';
	}	
	if(empty($_POST['email']))
	{
		$errors[] = '<br>-E-Mail not found!';
	}
	if(empty($_POST['re-email']))
	{
		$errors[] = '<br>-E-Mail check not found!';
	}
	if($_POST['password'] != $_POST['re-password'])
	{
		$errors[] = '<br>-Password and Password check not the same!';
	}	
	if($_POST['email'] != $_POST['re-email'])
	{
		$errors[] = '<br>-E-Mail and E-Mail check not the same!';
	}
    if(!ctype_alnum($_POST['username']))
	{
        $errors[] = '<br>-Username not allowed! Only alphabets and numbers allowed';	
    }
    if (strlen($_POST['password']) <4 || strlen($_POST['password']) >32)
	{
        $errors[] = '<br>-Password must be at least 4 and maximal 32 characters long';
    } 
	if ($accounts->username_exists($_POST['username']) === true || $accounts->email_exists($_POST['email']) === true)
	{
		$errors[] = '<br>-This Username or E-Mail already exists';
	}	
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false)
	{
        $errors[] = '<br>-E-Mail Address is not a valid input!';
    }	
		if(empty($errors) === true)
		{
			$username 	= htmlentities($_POST['username']);
			$password 	= $_POST['password'];
			$email 		= htmlentities($_POST['email']);

			$accounts->register($username, $password, $email );
			header('Location: register.php?success');

			exit();
		}
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/style.css" >
	<title>Register</title>
</head>
<body>
<div id="header"></div>

	<div id="container">
		<?php include 'includes/menu.php'; ?>
		<h1>Create Account</h1>
			
		<?php
		if (isset($_GET['success']) === true && empty($_GET['success']) === true) 
		{
			?>
			<h2_std>Registration complete,<br> please check your E-Mail to activate your Account.</h2_std>
			<?php
		}
		else 
		{
		?>
		<?php 
			if(empty($errors) === false)
			{
				echo '<h2_std>' . implode('</h2_std><h2_std>', $errors) . '</h2_std>';
			}
			?>
			<form method="post" action="">
				<input type="text" class="inputs" placeholder="Username" name="username" value="<?php if(isset($_POST['username'])) echo htmlentities($_POST['username']); ?>" ><br>
				<input type="password" class="inputs" placeholder="Password" name="password" /><br>
				<input type="password" class="inputs" placeholder="Password" name="re-password" /><br>
				<input type="text" class="inputs" placeholder="E-Mail" name="email" value="<?php if(isset($_POST['email'])) echo htmlentities($_POST['email']); ?>"/><br>
				<input type="text" class="inputs" placeholder="E-Mail" name="re-email" value="<?php if(isset($_POST['email'])) echo htmlentities($_POST['email']); ?>"/><br>
				<input type="submit" class="css_button" value="Register" name="submit" />
			</form>
			<?php	
		}
		?>
	</div>
</body>
</html>



























