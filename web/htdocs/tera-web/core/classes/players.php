<?php 
//incomplete! ToDo!


class Players
{
	private $db;

	public function __construct($database) 
	{

	$config = array(
	'host'		=> '127.0.0.1',
	'username' 	=> 'root',
	'password' 	=> '',
	'dbname' 	=> 'terax',
	);

	    $this->db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'], $config['username'], $config['password']);
	}	

	public function get_players()
	{
		$query = $this->db->prepare("SELECT * FROM `characters`");
		try
		{
			$query->execute();
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
		return $query->fetchAll();
	}	
}