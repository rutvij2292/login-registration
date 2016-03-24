<?php

require_once('dbconfig.php');
require_once('PassHash.php');

class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function register($userFirstName,$userLastName, $userEail, $userPass)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$stmt = $this->conn->prepare("INSERT INTO user_details (user_firstname,user_lastname,user_email,user_password) 
		                                               VALUES(:userFirstName, :userLastName, :userEail, :userPass)");
												  
			$stmt->bindparam(":userFirstName", $userFirstName);
			$stmt->bindparam(":userLastName", $userLastName);
			$stmt->bindparam(":userEail", $userEail);
			$stmt->bindparam(":userPass", $new_password);										  
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	
	public function doLogin($userEmail,$userPass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT user_id, user_firstname,user_lastname, user_email, user_password FROM user_details WHERE user_email=:userEmail");
		

			
			$stmt->execute(array(':userEmail'=>$userEmail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
		
			if($stmt->rowCount() == 1)
			{
				if(password_verify($userPass, $userRow['user_password']))
				{
					$_SESSION['user_session'] = $userRow['user_id'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function doLogout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
}
?>