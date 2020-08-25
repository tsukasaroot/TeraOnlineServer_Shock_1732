<?php 
include 'core/init.php';

if (isset($_POST['btn_send']))
{
	//Instance of PHPMailer
	$mail = new PHPMailer();
 	$mail->isSMTP(); // Set mailer to use SMTP
	$mail->SMTPSecure = 'tls';	
	$mail->Host = 'smtp.web.de:587'; //Specify main and backup server
  	$mail->SMTPAuth = true; // Enable SMTP authentication
	$mail->Username = 'email-username'; // SMTP username
	$mail->Password = 'email-password'; // SMTP password
	$mail->From     = 'email-adress';//email id of the person 
	$mail->AddAddress("email-adress");//my email id
	$mail->Subject = $subject;
	$mail->Body    = $message;
	$mail->WordWrap = 50;

if(!$mail->Send()) 
{
  echo 'Message was not sent.';
  echo 'Mailer error: ' . $mail->ErrorInfo;
}  
else 
	{
	echo 'Message has been sent.';
	}
}  

if(isset($_GET['username']) && empty($_GET['username']) === false)
{ // Putting everything in this if block.

 	$username = htmlentities($_GET['username']); // sanitizing the user inputed data (in the Url)
	if ($accounts->username_exists($username) === false)
	{ 
		//username doesn't exist, redirect to index page. Alternatively you can show a message or 404 error
		header('Location:index.php');
		die();
	}
	else
	{
		//username exists
		$profile_data 	= array();
		$account_id 	= $accounts->fetch_info('AccountId', 'login', $username); //get accountsid from username in Url.
		$profile_data	= $accounts->accountdata($account_id);
	} 
	?>
	<!doctype html>
	<html lang="en">
	<head>	
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="css/style.css" >
	 	<title>User <?php echo $username; ?>'s Profile</title>
	</head>
	<body>
<div id="header"></div>	
	
	    <div id="container">
			<?php include 'includes/menu.php'; ?>

				<h1><?php echo $profile_data['login']; ?>'s Profile</h1>
				<h2_hl><?php echo $profile_data['login']; ?></h2_hl>
				<h2_std> last logged in on: <?php echo date('F j, Y', $account['LastOnlineUtc'])?></h2_std><br><br>
	    		
				<?php if(!empty($profile_data['login']) && $account['login'] == $profile_data['login']){?>
				<?php 
				$general->logged_out_protect();?>
				<h2_std>AccountName: </h2_std><h2_hl> <?php echo $account['login']; ?></h2_hl><br>				
				<h2_std>Registered E-Mail: </h2_std><h2_hl> <?php echo $account['email']; ?></h2_hl><br>	
				<h2_std>AccessLevel: </h2_std><h2_hl> <?php echo $account['access_level']; ?></h2_hl><br>	
				<h2_std>Membership: </h2_std><h2_hl> <?php echo $account['Membership']; ?></h2_hl><br>					
				<h2_std>Coins: </h2_std><h2_hl> <?php echo $account['Coins']; ?></h2_hl><br>	
				<br>
				<h2_std>Password: </h2_std><a href="change-password.php"> *Change Password* </a></h2_std>
			
				<?php 
	    		} 
	    		?>		
	    </div>        
	</body>
	</html>
	<?php  
}
else
{
	header('Location: index.php'); //redirect to index if no username in Url
}