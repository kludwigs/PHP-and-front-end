<?php
	session_start();
	require("connection.php");

	$user = IsLoggedIn();

	if($user)
	{
		$expires = time() + 60*3;
		$command = "UPDATE active_users SET expires = $expires WHERE user = $user";
		//echo $command;
		mysql_query($command);	
	}

	function IsLoggedIn() 
	{
		$sessID = mysql_real_escape_string(session_id());
		$hashsession = mysql_real_escape_string(hash("sha512", $sessID.$_SERVER['HTTP_USER_AGENT']));
		$now = time();
		$command = "SELECT user FROM active_users WHERE session_id = '" . ($sessID) . "' AND hash = '". $hashsession . "' AND expires > $now";
		//echo $command;
		$query = mysql_query($command);		
		if(mysql_num_rows($query))
		{
			$data = mysql_fetch_assoc($query);
			return $data['user'];	
		}
		else
		{
			return false;
		}
	}
?>