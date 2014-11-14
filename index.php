<?php


require_once 'twitteroauth.php';

define('CONSUMER_KEY', 'e4RO5ARwJTCyjUnTGB6zubUOw');
define('CONSUMER_SECRET', '88BV7wbaPp6GNCIjo8I7QyV44pgN5fqVNU93w5W81IjY9CzAa8');
define('ACCESS_TOKEN', '27367983-wlU3yG3wQhj3K12TKDOXOCkaRcU5mtC1KrH2i2knv');
define('ACCESS_TOKEN_SECRET', 'NULPQCR3Ew4IAXrxDjkY7lhRADPOQLsZ8CVwDGDGu6vzY');

$toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);

$query = array(
    'q' => '#lagoa'
);

$results = $toa->get('search/tweets', $query);


echo "  <html>

<head>
<title> Festa do Online</title>
<meta http-equiv="refresh" content="30">
</head>

<body>";

echo "<ul class='posts'>";


foreach ($results->statuses as $result) {
	if (isset($result->entities->media)) {
    	foreach ($result->entities->media as $media) {
        	$media_url = $media->media_url;
        	echo "<li class='twitter'> <img src=". $result->entities->media[0]->media_url ." /> </li>" ;
    	}
	}
}

function callInstagram($url)
{
$ch = curl_init();
curl_setopt_array($ch, array(
CURLOPT_URL => $url,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_SSL_VERIFYPEER => false,
CURLOPT_SSL_VERIFYHOST => 2
));

$result = curl_exec($ch);
curl_close($ch);
return $result;
}

$tag = 'lagoa';
$client_id = "9e30b7bf8daa48339a3c65c805094565";

$url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?client_id='.$client_id;

$inst_stream = callInstagram($url);
$results = json_decode($inst_stream, true);

foreach($results['data'] as $item){
    $image_link = $item['images']['low_resolution']['url'];
    echo '<li class="insta"><img src="'.$image_link.'" /></li>';
}
?>

<?php


echo "</ul>";

echo "<script type='text/javascript' src='http://localhost/twitter/jquery.js'></script>";

echo "  </body> </html>";

?>
