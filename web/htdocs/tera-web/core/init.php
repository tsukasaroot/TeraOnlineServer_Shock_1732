<?php 
session_start();
require 'connect/database.php';
require 'classes/accounts.php';
require 'classes/players.php';
require 'classes/general.php';
require 'classes/class.phpmailer.php';
require 'classes/class.smtp.php';

// error_reporting(0);

$general 	= new General();
$accounts 	= new Accounts($db);
$players 	= new Players($db);

$errors = array();

if ($general->logged_in() === true)  
{
	$account_id 	= $_SESSION['Id'];
	$account 		= $accounts->accountdata($account_id);
}

ob_start(); // Added to avoid a common error of 'header already sent'