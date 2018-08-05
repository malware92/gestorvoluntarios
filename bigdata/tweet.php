<?php
require_once('TwitterAPIExchange.php');

$settings = array(
    'oauth_access_token' => "981988292903297026-JwxM57IkDBJyGnOsy7F3hAs69ZGGIn0",
    'oauth_access_token_secret' => "nyeUVGNspNNS47Q39NCmWZVGm1j7Kpu6vjMlIWprDJlno",
    'consumer_key' => "RHOWhaZhFj1LgmHtocHNv0KCi",
    'consumer_secret' => "cRWVGClCFLGdEJuGpAA2gF5SQwJWC6KoPiuLHEOB3erF6HYQ1e"
);
	
if( isset($_POST['param']) ) {

	$url = 'https://api.twitter.com/1.1/search/tweets.json';
	$getfield = '?q='.$_POST['param'].'&count=100&until=2018-05-13';
	$requestMethod = 'GET';
	
	
	
	$twitter = new TwitterAPIExchange($settings);
	$results = $twitter->setGetfield($getfield)
		->buildOauth($url, $requestMethod)
		->performRequest();
	
	
} else {

   $twitter= array();
   $twitter['success'] = false;
   $twitter['message'] = 'Error en consulta.';
	$results = $twitter;
}

//Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
header('Content-type: application/json; charset=utf-8');

// output as JSON
echo $results;


?>