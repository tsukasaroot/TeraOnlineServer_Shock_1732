<?php 

class Accounts
{
	private $db;
	
	public function __construct($database) 
	{
	    $this->db = $database;
	}
	
	public function accountdata($id)
	{
		$query = $this->db->prepare("SELECT * FROM `accounts` WHERE `AccountId`= ?");
		$query->bindValue(1, $id);

		try
		{
			$query->execute();
			return $query->fetch();
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}
	public function fetch_info($what, $field, $value)
	{
		$allowed = array('AccountId', 'login', 'Email');
		//you can add more! do not add 'password'!
		if (!in_array($what, $allowed, true) || !in_array($field, $allowed, true)) 
		{
		    throw new InvalidArgumentException;
		}
		else
		{
			$query = $this->db->prepare("SELECT $what FROM `accounts` WHERE $field = ?");
			$query->bindValue(1, $value);

			try
			{
				$query->execute();
			} 
			catch(PDOException $e)
			{
				die($e->getMessage());
			}
			return $query->fetchColumn();
		}
	}	

	public function account_getaccounts()
	{
		$query = $this->db->prepare("SELECT * FROM `accounts` ORDER BY `LastOnlineUtc` DESC");
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
	public function username_exists($username) 
	{
		$query = $this->db->prepare("SELECT COUNT(`AccountId`) FROM `accounts` WHERE `login`= ?");
		$query->bindValue(1, $username);
		
		try
		{
			$query->execute();
			$rows = $query->fetchColumn();
			if($rows == 1)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		catch (PDOException $e)
		{
			die($e->getMessage());
		}
	}
    public function email_exists($email) 
	{
		$query = $this->db->prepare("SELECT COUNT(`AccountId`) FROM `accounts` WHERE `Email`= ?");
		$query->bindValue(1, $email);
	
		try
		{
			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		catch (PDOException $e)
		{
			die($e->getMessage());
		}
	}
	public function account_activated($username)
	{
		$query = $this->db->prepare("SELECT COUNT(`AccountId`) FROM `accounts` WHERE `login`= ? AND `access_level` = ?");
		$query->bindValue(1, $username);
		$query->bindValue(2, 1);
		
		try
		{
			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1)
			{
				return true;
			}
			else
			{
				return false;
			}

		} 
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}
	public function login($username, $password) 
	{
		$query = $this->db->prepare("SELECT `Password`, `AccountId` FROM `accounts` WHERE `login` = ?");
		$query->bindValue(1, $username);
		try
		{
			$query->execute();
			$data 				= $query->fetch();
			$stored_password 	= $data['Password'];//stored password hash
			$account_id   		= $data['AccountId'];//accountid returned if password is verified, below.
			
			if((md5($password) == $stored_password) === true)
			{ 
				//using the verify method to compare the password with the stored hashed password.
				return $account_id;	// returning the user's id.
			}
			else
			{
				return false;	
			}
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}
	public function register($username, $password, $email)
	{
		include 'config.accounts.php';
		include 'config.phpmailer.php';
		
		$password   		= md5($password);
		if($useAccountActivation == 1){	$accesslevel = "0";	} //use config.accounts.php
		else if ($useAccountActivation == 0){ $accesslevel = "1"; }
		$membership			= $newAccountMembership; //use config.accounts.php
		$isgm				= $newAccountisGM; //use config.accounts.php
		$lastonlineutc 		= time();
		$coins 				= $newAccountCoins; //use config.accounts.php
		$ip					= $_SERVER['REMOTE_ADDR']; // getting the users IP address
		$emailverify		= uniqid('code_',true); // Creating a unique string. //for email verification

		$query 	= $this->db->prepare("INSERT INTO `accounts` (`login`, `Password`, `Email`, `access_level`, `Membership`, `isGM`, `LastOnlineUtc`, `Coins`, `Ip`, `EmailVerify`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");

		$query->bindValue(1, $username);
		$query->bindValue(2, $password);
		$query->bindValue(3, $email);
		$query->bindValue(4, $accesslevel);
		$query->bindValue(5, $membership);
		$query->bindValue(6, $isgm);
		$query->bindValue(7, $lastonlineutc);
		$query->bindValue(8, $coins);
		$query->bindValue(9, $ip);
		$query->bindValue(10, $emailverify);

		try
		{
			$query->execute();
			$this->sendmail($WebsiteNameInEMail . " Account Activation", "Hello " . $username. ", Please visit the link below to activate your account: " . $ServerAddress . "activate.php?email=" . $email . "&emailverify=" . $emailverify . " --". $TeamNameInEMail . "", $email);
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}	
	}
	public function sendmail($subject, $message, $toemail)
	{
	include 'config.phpmailer.php';
	
	//Instance of PHPMailer
	$mail = new PHPMailer();
 	$mail->isSMTP(); // Set mailer to use SMTP
	$mail->SMTPSecure = 'tls';	
	$mail->Host = $smtpHost; //config.phpmailer.php
  	$mail->SMTPAuth = true; //config.phpmailer.php
	$mail->Username = $smtpUsername; //config.phpmailer.php
	$mail->Password = $smtpPassword; ///config.phpmailer.php
	$mail->From = $smtpFrom; //config.phpmailer.php
	$mail->FromName = $smtpFromName; //config.phpmailer.php
	$mail->AddAddress($toemail);
	$mail->Subject = $subject;
	$mail->Body    = $message;
	$mail->WordWrap = 100;

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
	public function activate_account($email, $emailverify)
	{
		$query = $this->db->prepare("SELECT COUNT(`AccountId`) FROM `accounts` WHERE `Email` = ? AND `EmailVerify` = ? AND `access_level` = ?");

		$query->bindValue(1, $email);
		$query->bindValue(2, $emailverify);
		$query->bindValue(3, 0);

		try
		{
			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1)
			{
				$query_2 = $this->db->prepare("UPDATE `accounts` SET `access_level` = ? WHERE `Email` = ?");
				$query_2->bindValue(1, 1);
				$query_2->bindValue(2, $email);				
				$query_2->execute();
				return true;
			}
			else
			{
				return false;
			}
		} 
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}
	public function change_password($account_id, $password)
	{
		$password_hash = md5($password);
		$query = $this->db->prepare("UPDATE `accounts` SET `Password` = ? WHERE `AccountId` = ?");
		$query->bindValue(1, $password_hash);
		$query->bindValue(2, $account_id);
		try
		{
			$query->execute();
			return true;
		} 
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}
	public function password_recovery($email, $password_recovery)
	{
		include 'config.phpmailer.php';
			
		if($password_recovery == 0)
		{
			return false;
		}
		else
		{
			$query = $this->db->prepare("SELECT COUNT(`AccountId`) FROM `accounts` WHERE `Email` = ? AND `PasswordRecovery` = ?");

			$query->bindValue(1, $email);
			$query->bindValue(2, $password_recovery);

			try
			{
				$query->execute();
				$rows = $query->fetchColumn();

				if($rows == 1)
				{
					$username = $this->fetch_info('login', 'Email', $email); //get username for the use in the email.
					$account_id  = $this->fetch_info('AccountId', 'Email', $email);//keep things standard and use accountid for most of the operations. Therefore, we use id instead of email.
			
					$charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
					$generated_password = substr(str_shuffle($charset),0, 10);

					$this->change_password($account_id, $generated_password);
					$query = $this->db->prepare("UPDATE `accounts` SET `PasswordRecovery` = 0 WHERE `AccountId` = ?");
					$query->bindValue(1, $account_id);
					$query->execute();
				
					$this->sendmail($WebsiteNameInEMail . " Password Recovery",  "Hello " . $username. " , Your new Password is: " .$generated_password. " Please change it after your next Login, Thnx. --". $TeamNameInEMail . "", $email);		
				}
			}
			catch(PDOException $e)
			{
				die($e->getMessage());
			}
		}
	}
	public function confirm_password_recovery($email)
	{
		include 'config.phpmailer.php';
	
		$username = $this->fetch_info('login', 'Email', $email);// We want the 'id' WHERE 'email' = user's email ($email)
		$unique = uniqid('',true);
		$random = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0, 10);
		$password_recovery = $unique . $random; // a random and unique string
		$query = $this->db->prepare("UPDATE `accounts` SET `PasswordRecovery` = ? WHERE `Email` = ?");
		$query->bindValue(1, $password_recovery);
		$query->bindValue(2, $email);
		try
		{
			$query->execute();
			$this->sendmail($WebsiteNameInEMail . " Password Recovery",  "Hello " . $username. " , Please visit the link below to recover your password: " . $ServerAddress . "recover.php?email=" .$email. "&password_recovery=" .$password_recovery. " We will generate a new password for you and send it to your E-Mail Address. --". $TeamNameInEMail . "", $email);
		
		} 
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}
	public function confirm_activation_request($email)
	{
		include 'config.phpmailer.php';
		
		$username = $this->fetch_info('login', 'Email', $email);// We want the 'id' WHERE 'email' = user's email ($email)
		$emailverify = uniqid('code_',true); // Creating a unique string. //for email verification
		$query = $this->db->prepare("UPDATE `accounts` SET `EmailVerify` = ? WHERE `Email` = ?");
		$query->bindValue(1, $emailverify);
		$query->bindValue(2, $email);
	
		try
		{
			$query->execute();
			$this->sendmail($WebsiteNameInEMail . " Account Activation", "Hello " . $username. ", Please visit the link below to activate your account: " . $ServerAddress . "activate.php?email=" . $email . "&emailverify=" . $emailverify . " --". $TeamNameInEMail . "", $email);
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}
}