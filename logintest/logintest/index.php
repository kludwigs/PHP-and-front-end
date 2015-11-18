<html>

<head>
<link rel="stylesheet" Type="text/css" href="styles.css">
</head>

<?php
require("header.inc.php");
?>

<?php if(!IsLoggedIn()): ?>
	<h1> Login Form </h1>
	<form id = "loginForm" action="login.php" method="post">	
		<p>email:<input type="text" name="username" id = "username"></p>	
	  	<p>pass:<input type="password" name="password" id = "password"></p>  	
	  	<button type="submit" name="submitButton" id="Submit">Submit</button>
	</form>	
<?php else : ?>
	<form id = "loginForm" action="logout.php" method="get">		
	  	<button type="submit" name="submitButton" id="Submit">LogOut</button>
	</form>	
<?php endif; ?>

</html>