<?php

header("Content-type: text/javascript");


$myproducts = array(
		array(
			'name' => "Callaway Driver",
			'category' => "Golf",
			'price' => 200.00,
			'description' => "Fantastic driver. Used for hitting long!"
		),
		array(
			'name' => "Lucky Jeans",
			'category' => "Pants",
			'price' => 100.00,
			'description' => "Nice comfortable jeans."
		),
		array(
			'name' => "Nord Fire 3",
			'category' => "Musical Instruments",
			'price' => 2500.00,
			'description' => "Nords new B3 Organ simulator! Reach new heights!" 
		)
);
echo json_encode($myproducts);

?>