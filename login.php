<?php
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__DIR__.'\class.user.php'); 
$user = new USER();

	if(isset($_POST['btnLogin']))
	{
		$email = strip_tags($_POST['login_email']);
		$password = strip_tags($_POST['login_password']);	

		if($user->doLogin($email, $password))
		{
			echo "Logged In Successfully";

			/*
				Redirect from here;
			*/
		}
		else
		{
			echo "Error while login!";
		}
	}
	else
	{
		echo "get lost";
	}
	
?>