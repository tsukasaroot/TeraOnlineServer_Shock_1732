<?php 
include_once 'core/init.php';
$general->logged_out_protect();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css" >
    <title>Change Password</title>
</head>
<body>
<div id="header"></div>

    <div id="container">        
    	<?php
        include 'includes/menu.php';
		
        if(empty($_POST) === false)
		{
            if(empty($_POST['current_password']) || empty($_POST['password']) || empty($_POST['password_again']))
			{
                $errors[] = 'All fields are required';
            }
			else if((md5($_POST['current_password']) == $account['password']) === true)
			{
                if (trim($_POST['password']) != trim($_POST['password_again'])) 
				{
                    $errors[] = 'Your new passwords do not match';
                } 
				else if (strlen($_POST['password']) < 4) 
				{ 
                    $errors[] = 'Your password must be at least 4 characters';
                } 
				else if (strlen($_POST['password']) >32)
				{
                    $errors[] = 'Your password cannot be more than 32 characters long';
                } 
            } 
			else 
			{
                $errors[] = 'Your current password is incorrect';
            }
        }

        if (isset($_GET['success']) === true && empty ($_GET['success']) === true )
		{
    		echo '<h2_std>Your password has been changed!</h2_std>';
        } 
		else
		{?>
            <h1>Change Password</h1>

            <?php
            if (empty($_POST) === false && empty($errors) === true)
			{
                $accounts->change_password($account['AccountId'], $_POST['password']);
                header('Location: change-password.php?success');
            }
			else if (empty ($errors) === false)
			{
                echo '<h2_std>' . implode('</h2_std><h2_std>', $errors) . '</h2_std>';  
            }
            ?>
			
	<form action="" method="post">
		<input type="password" name="current_password" class="inputs" placeholder="Current Password"><br>
		<input type="password" name="password" class="inputs" placeholder="New Password"><br>
		<input type="password" name="password_again" class="inputs" placeholder="Confirm New Password"><br>
		<input type="submit" class="css_button" value="Change Password">
	</form>
    	<?php 
        }
        ?> 
    </div>
</body>
</html>