<?php 
require 'core/init.php';
$general->logged_in_protect();

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/style.css" >
	<title>ProjectS1-Development Server </title>
</head>
<body>	
<div id="header">
</div>
	<div id="container">
		<?php include 'includes/menu.php'; ?>
		<h1>Tera - Project S1 Development Server</h1>
		<h2_hl>Development Status:</h2_hl><br>
		<h2_hl>Website:</h2_hl><br>
		<h2_std>-XAMPP: Updated WebServer to Xampp Version: 7.3.9 </h2_std><br>
		<h2_std>-QuickFix: Website Update to work with TeraShock GameServer now.</h2_std><br>
		<h2_std>-Working: Register, Login, PasswordChange.</h2_std><br>
		<h2_std>-Don´t use Email-Verification, not tested if working... </h2_std><br>

        
		<h2_hl>Login:</h2_hl><br>
		<h2_std>-Configured auth.php/auth-config.php to work with NeoLauncher v0.7.3b</h2_std><br>
		<h2_std>- </h2_std><br>
		
		<h2_hl>GameServer:</h2_hl><br>
		<h2_std>-Client Revision: 1732 (TERA Shock)</h2_std><br>
		<a href="https://mega.nz/#F!RJdmgAaQ!1lQJdA0irA4vu6gEw2x37w"><h2_hl>mega download</h2_hl></a><br />
		<a href="/client/"><h2_hl>Download game</h2_hl></a>
	</div>
</body>
</html>