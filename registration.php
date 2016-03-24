<?php
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__DIR__.'\class.user.php'); 
$user = new USER();

if(isset($_POST['registration']))
{
	echo "Button is set";

	$firstname = strip_tags($_POST['user_firstname']);
	$lastname = strip_tags($_POST['user_lastname']);
	$email = strip_tags($_POST['user_email']);
	$password = strip_tags($_POST['user_password']);


	//echo $firstname ."  ". $lastname . " ". $email;

	//$error_message = array("User is already existed");

	
	if($user->register($firstname, $lastname,$email, $password))
	{
		echo "Successfully Inserted New User";
	}
	else
	{
		echo "Error while login!";
	}
}
else
{
	echo "Button is not setted";
}
?>	