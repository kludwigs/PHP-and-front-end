<html>

<head>
<link rel="stylesheet" Type="text/css" href="styles.css">
</head>

<?php
require("header.inc.php");
if (IsLoggedIn())
{
echo"<h1> Congrulations you are logged in!<br>";
}
else
	echo "<strong> Access Denied<br>";
?>
<?php if(IsLoggedIn()): ?>
	<br>
	<form id = "logoutForm" action="logout.php" method="get">		
	<button type="submit" name="logoutButton" id="Submit"><h2>Log out</h2></button>
	</form>	
<?php endif; ?>

</html>