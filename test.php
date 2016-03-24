<?php

	echo isset($_POST['registration']);
	echo isset($_POST['user_login']); 
	if(isset($_POST['registration']))
	{
		echo "Hello! How are you?";
	}
	else
	{
		if(isset($_POST['user_login']))
		{
			echo "I am set";
		}
	}

?>