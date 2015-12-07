<?php
//get the q parameter from URL
$q=$_GET["q"];

//find out which feed was selected

//http://imgur.com/r/aww/rss

$xml="http://imgur.com/r/";
$xml.=$q;
$xml.="/rss";

$xmlDoc = new DOMDocument();
//$xmlDoc->load($xml);

$xmlDoc->load($xml);

//$x = $xmlDoc->documentElement;

//$display_string = $xml . "<br>";

$text = (string)file_get_contents($xml);

$newstr = (removeEverythingBefore($text, "a href"));

$add = "<a href";
$newstr = $add . $newstr;

$decodeString= htmlspecialchars_decode($newstr);

//$doc = new DOMDocument();

//$doc->loadHTML($decodeString);
//$doc->saveHTML();

//$elements = $doc->getElementsByTagName('a');

echo $decodeString;

exit;

function removeEverythingBefore($in, $before) 
{
    $pos = strpos($in, $before);
    return $pos !== FALSE
        ? substr($in, $pos + strlen($before), strlen($in))
        : "";
}



//$post_images = array();

// Get all images


// Loop the images and add the raw img html tag to $post_images
/*
preg_match_all('/<img (.+)>/', $text, $image_matches, PREG_SET_ORDER);
foreach ($image_matches as $image_match)
{
	$post_image->html = $image_match[0];
	
	// If attributes have been requested get them and add them to the $post_image

		preg_match_all('/\s+?(.+)="([^"]*)"/U', $image_match[0], $image_attr_matches, PREG_SET_ORDER);
		
		foreach ($image_attr_matches as $image_attr)
		{
			$post_image->attr->{$image_attr[1]} = $image_attr[2];
		}
	$post_images[] = $post_image;

}
foreach($post_images as $image)
{ 
	$display_string .= $image . "<br>";	
	$display_string .= "COOL <br>";
}
echo $display_string;

*/


/*
foreach ($x->childNodes AS $item) 
{ 	
  $display_string .= $item->nodeName . " = " . $item->nodeValue . "<br>";
}
echo $display_string;

$response = http_get("http://www.example.com/", array("timeout"=>1), $info);
print_r($info);



*/




?>