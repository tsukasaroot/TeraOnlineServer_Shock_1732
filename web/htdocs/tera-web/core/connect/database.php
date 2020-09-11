<?php 
$config = array(
	'host'		=> '127.0.0.1',
	'username' 	=> 'root',
	'password' 	=> '',
	'dbname' 	=> 'terax',
);

$db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'], $config['username'], $config['password']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


