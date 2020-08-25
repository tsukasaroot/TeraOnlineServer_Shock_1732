<?php 
require 'core/init.php';
$general->logged_in_protect();

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/style.css" >
	<title>Account Activation</title>
</head>
<body>	
	<div id="container">
	<?php include 'includes/menu.php'; ?>
		<h1>Account Activation</h1>

    	<?php
        if (isset($_GET['success']) === true && empty ($_GET['success']) === true)
		{
	        ?>
	        <h2_std>Thank's, we've activated your account.<br> You're free to log in!</h2_std>
	        <?php
        } 
		else if (isset ($_GET['email'], $_GET['emailverify']) === true) 
		{
            $email			=trim($_GET['email']);
            $emailverify	=trim($_GET['emailverify']);	
            
            if ($accounts->email_exists($email) === false) 
			{
                $errors[] = 'Sorry, we couldn\'t find that email address';
            } 
			else if ($accounts->activate_account($email, $emailverify) === false) 
			{
                $errors[] = 'Sorry, we have failed to activate your account';
            }
			if(empty($errors) === false)
			{
				echo '<h2_std>' . implode('</h2_std><h2_std>', $errors) . '</h2_std>';	
			} 
			else 
			{
                header('Location: activate.php?success');
                exit();
            }
        }
		else 
		{
            header('Location: index.php');
            exit();
        }
        ?>
	</div>
</body>
</html>