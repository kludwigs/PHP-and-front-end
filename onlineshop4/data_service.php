<?php

header('Content-Type: application/json');

$HTTPS_required = false;
$authentication_required = true;

$api_response_code = array(
	0 => array('HTTP Response' => 400, 'Message' => 'Unknown Error'),
	1 => array('HTTP Response' => 200, 'Message' => 'Success'),
	2 => array('HTTP Response' => 403, 'Message' => 'HTTPS Required'),
	3 => array('HTTP Response' => 401, 'Message' => 'Authentication Required'),
	4 => array('HTTP Response' => 401, 'Message' => 'Authentication Failed'),
	5 => array('HTTP Response' => 404, 'Message' => 'Invalid Request'),
	6 => array('HTTP Response' => 400, 'Message' => 'Invalid Response Format')
);

if($HTTPS_required && $_SERVER['HTTPS'] != 'on')
{
	$response['code'] = 2;
	$response['status'] = $api_response_code[$response['code']]['HTTP Response'];
	$response['message'] = $api_response_code[$response['code']]['Message'];
	
	sendresponse($response);
}

if($authentication_required == true)
{
	// $_POST
	// $_GET
	
	if (empty($_POST['securitycode']) || empty($_POST['passkey']))
	{
		$response['code'] = 3;
		$response['status'] = $api_response_code[$response['code']]['HTTP Response'];
		$response['message'] = $api_response_code[$response['code']]['Message'];		
		sendresponse($response);	
	}
	else if($_POST['securitycode'] != 'foo' || ($_POST['passkey']) != 'bar')
	{
		$response['code'] = 4;
		$response['status'] = $api_response_code[$response['code']]['HTTP Response'];
		$response['message'] = $api_response_code[$response['code']]['Message'];	
		
		sendresponse($response);			
	}
}
/* we passed - send the data back */

$response['code'] = 1;
$response['status'] = $api_response_code[$response['code']]['HTTP Response'];
$response['message'] = $api_response_code[$response['code']]['Message'];		
$response['data'] = GetData();

sendresponse($response);

function sendresponse($response)
{
	header('HTTP/1.1 '.$response['status']. ' '.$response['message']);
	header('Content-Type: application/json; charset=utf-8');
	
	echo json_encode($response);
	
	exit;
}

function GetData()
{	
	$product_list = array(
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
		),
		array(
			'name' => "Zone Monitor Speakers",
			'category' => "Electronics",
			'price' => 500.00,
			'description' => "Great quality sounding speakers. Turn them up for your next party!" 
		)		
	);	
	return $product_list;
}
?>

