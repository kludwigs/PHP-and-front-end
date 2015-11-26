<?php

require("get_connected.php");

if(!isset($_GET['username']) || empty($_GET['username']))
{
	die("Dude, you have to input a user!");
}
else
{
	$username = mysql_escape_string($_GET['username']);
}
$command = "SELECT * from usercollection_tb WHERE name = '$username'";
$query_result = mysql_query($command) or die("something went wrong...");


//$number = 
if(mysql_num_rows($query_result) > 0)
{
	$row = mysql_fetch_assoc($query_result) or die("what happened?");	
}
else
{
	die("User was not found!");
}

//(`user_id`, `animal`, `instrument`, `city`, `name`)

//build display_string

$display_string =  "<h3> Entry Found!</h3>";
//$display_string .= "Query:".$command."<br/>";

$display_string .= "<table>";

$display_string .= "<tr>";
$display_string .= "<th>--animal -- </th>";
$display_string .= "<th>--instrument--</th>";
$display_string .= "<th>--city--</th>";
$display_string .= "<th>--name--</th>";
$display_string .= "</tr>";

$result_animal = $row['animal'];
$result_instrument = $row['instrument'];
$result_city = $row['city'];
$result_username= $row['name'];

$display_string .= "<tr>";
$display_string .= "<td>$result_animal</td>";
$display_string .= "<td>$result_instrument</td>";
$display_string .= "<td>$result_city</td>";
$display_string .= "<td>$result_username</td>";
$display_string .= "</tr>";

$display_string .="</table>";

echo $display_string;

function IsConnected()
{
	return $GLOBALS['isConnectedvar'];
}

?>