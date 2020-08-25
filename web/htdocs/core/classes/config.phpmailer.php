<?php
//Add SMTP Server, else Email Verification & Password Recovery is not working! 
 
//Main E-Mail SMTP Server
$smtpHost		= 'smtp.johndoe.de:587'; 

//SMTP Username
$smtpUsername 	= 'john@doe.de'; 

//SMTP Password
$smtpPassword 	= 'john.doe'; 

//Email Used for Sender
$smtpFrom 		= 'john@doe.de'; 

//Name Used for Sender
$smtpFromName	= 'Project S1 Admin'; 

//Used in Email Message
$WebsiteNameInEMail  = 'Project S1';

//Used in Email Message
$TeamNameInEMail  = 'Project S1 Dev-Team'; 

//Address to Files: actvate.php, recover.php (root of Webserver)
$ServerAddress  = 'http://127.0.0.1/';

