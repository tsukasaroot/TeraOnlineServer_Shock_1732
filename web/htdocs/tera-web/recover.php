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
    	<?php
		
        if (isset($_GET['success']) === true && empty ($_GET['success']) === true) 
		{
            ?>
            <h2_std>Thank you, we've send you a randomly generated password to your email.</h2_std>
            <?php
        } 
		else 
		if (isset ($_GET['email'], $_GET['password_recovery']) === true) 
		{
            $email	=trim($_GET['email']);
            $string	=trim($_GET['password_recovery']);	
            
            if ($accounts->email_exists($email) === false || $accounts->password_recovery($email, $string) === false) 
			{
                $errors[] = 'Sorry, something went wrong and we couldn\'t recover your password.';
            }
            if (empty($errors) === false) 
			{    		
        		echo '<h2_std>' . implode('</h2_std><h2_std>', $errors) . '</h2_std>';
    			
            } 
			else 
			{
                header('Location: recover.php?success');
                exit();
            }
        }
		else 
		{
            header('Location: index.php'); // If the required parameters are not there in the url. redirect to index.php
            exit();
        }
        ?>
    </div>
</body>
</html>