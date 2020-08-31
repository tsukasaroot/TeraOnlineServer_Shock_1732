<?php
//removed for launcher
/*session_start();
if(basename($_SERVER["PHP_SELF"]) == "auth.php")
{
	die("403 - Access Forbidden");
}
*/


if(empty($_GET['username']))
{
        echo ('empty_user');
}
else if(strlen($_GET['username']) < 4)
{
        echo ('small_user');
}
else if(empty($_GET['password']))
{
        echo ('empty_pass');
}
else if(strlen($_GET['password']) < 4)
{
        echo ('small_pass');
}
else 
{
	require_once("auth-config.php");
    
	$username = $mysqli->real_escape_string($_GET['username']);
	//password should be sent already encrypted...
    $password = $mysqli->real_escape_string($_GET['password']);
	
    $check = $mysqli->query("SELECT * from ".$database['table']." WHERE ".$database['username']." = '".$username."' AND ".$database['password']." = '".$password."'");
    
	if($check->num_rows == 1)
	{
		$account = $check->fetch_assoc();
		//no need for a session in launcher...
        //$_SESSION['id'] = $account['id'];
		//$_SESSION['name'] = $account['name'];
		/* no need for admin checks for launcher
        if($account['admin'] == 1) 
		{
			$_SESSION['admin'] = $account['admin'];
		}*/
		//$_SESSION['success'] = 1;
        echo ('success');
	}
    else if($check->num_rows != 1)
    {
        echo ('wrong');
    }
    else 
	{
        echo ('error');
	}
    
    $mysqli->close();
    //session_destroy();

}
?>
