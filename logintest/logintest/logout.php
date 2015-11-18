<html>

<head>
<link rel="stylesheet" Type="text/css" href="styles.css">
</head>

<?php
require("header.inc.php");

$user = IsLoggedIn();
$comand = "DELETE FROM active_users WHERE user = $user";
$query = mysql_query($comand);
Header("Location: ./index.php");
?>



</html>