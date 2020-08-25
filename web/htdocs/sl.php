<?php
require 'core/init.php';
$general->logged_in_protect();


if (empty($_POST) === false) 
{
	$serverlist = trim($_POST['serverlist']);

	if (empty($serverlist) === true) 
	{
		echo ('SL_RequestStringEmpty');
		exit();
	}
	//send serverlist
	else 
	{
		if ($serverlist === 'de') //de
		{
			echo ('SL_RequestStringDE');
			exit();
		}
		if ($serverlist === 'en') //en
		{
			echo ('SL_RequestStringEN');
			exit();
		}
		if ($serverlist === 'fr') //fr
		{
			echo ('SL_RequestStringFR');
			exit();
		}
		if ($serverlist === false) //request fail
		{
			echo ('SL_RequestStringFail');
			exit();
		}
	}
} 

?>

		
		