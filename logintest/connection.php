<?php

$dbUser = "root";
$dbPass = "kpl321";
$dbDatabase = "logintest_db";
$dbHost = "localhost";
$isConnectedvar = false;

$dbConn = mysql_connect($dbHost, $dbUser, $dbPass);

if($dbConn)
{
	mysql_select_db($dbDatabase);
	//print("<strong>Succesfully connected to the database!</strong><br>");
	$isConnectedvar = true;
}
else
{
	die("<string>Error:</strong> Could not connect to the database");
}

function IsConnected()
{
	return $GLOBALS['isConnectedvar'];
}

?>