<?php
require("header.inc.php");
if (IsLoggedIn())
{
echo"<h1> Congrulations you are logged in<br>";
}
else
	echo "<strong> Access Denied<br>";

?>