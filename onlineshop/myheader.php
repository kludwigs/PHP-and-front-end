<?php

/* 
File: 		myheader.php
Author:		karl
Contains HTML blocks of myheader
*/

$header = <<<HTML
<!doctype HTML public>
<html>
	<head>
		<title>WebMart - Shop til you drop!</title>
		<link rel='stylesheet' type='text/css' href='./mystyles.css' />		
	<script src="myjavascript.js">
	</script>
	</head>
	<body>
		<div id='container'>
			<div id='header'>
				<h2 style='text-align:center;'>Welcome to Web Mart!</h2>
					<p style='text-align:center;'><a href='./index.php?view_cart=1'>View Cart</a></p>
			</div>
								
			<div id='content'>
			<div id='message_box'><br></div>
HTML;
$footer = <<<HTML
			</div><!-- End content-->
		</div><!-- End container-->
	</body>
</html>
HTML;

?>
