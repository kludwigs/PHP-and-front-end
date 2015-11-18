<?php

require("header.inc.php");

if(isset($_POST['submitButton']))
{

	if(!isset($_POST['username']) || empty($_POST['username']))
	{
		mydie("Error: The username field was not set <br>");
	}

	if(!isset($_POST['password']) || empty($_POST['password']))
	{		
		mydie("Error: The password field was not set <br>");
	}

	$username = $_POST['username'];
	$password = $_POST['password'];
	$hash = hash("sha512", $password);

	$query = mysql_query("SELECT id FROM users WHERE email = '" . mysql_real_escape_string($username) . "' AND password = '" . mysql_real_escape_string($hash) . "'");
	if(mysql_num_rows($query))
	{
		$sessID = mysql_real_escape_string(session_id());
		$hashsession = mysql_real_escape_string(hash("sha512", $sessID.$_SERVER['HTTP_USER_AGENT']));
		$expires = time() + 60*3;		
		$userdata =mysql_fetch_assoc($query);
		$userdataid = $userdata['id'];

		$insert = "INSERT INTO active_users (id, user, session_id, hash, expires) 
			VALUES(
			''
			,$userdataid
			,'$sessID'
			,'$hashsession'
			,$expires)";			

		mysql_query($insert) or die ("Active User SQL Insert failed");	
		Header("Location: ./home.php");

	}
	else 
	{
		mydie("Error: Incorrect password or email address");
	}
}

function mydie($msg)
{
	die($msg);
}


?>