<?php

function akismet($apikey,$path,$data=array(),$port = 80) {

	$host = $apikey.".rest.akismet.com";

	$request = "";

	foreach ($data as $key => $value) {

		$request.= urlencode(stripslashes($key));
		$request.= "=";
		$request.= urlencode(stripslashes($value));
		$request.= "&";

	}

	$request = substr($request,0,-1);

	$http_request  = "POST ".$path." HTTP/1.0\r\n";
	$http_request .= "Host: ".$host."\r\n";
	$http_request .= "Content-Type: application/x-www-form-urlencoded;\r\n";
	$http_request .= "Content-Length: " . strlen($request) . "\r\n";
	$http_request .= "User-Agent: Scrabbage/0.1 | Akismet/1.11\r\n";
	$http_request .= "\r\n";
	$http_request .= $request;

	$response = '';
	if( false !== ( $fs = @fsockopen($host, $port, $errno, $errstr, 3) ) ) {
		fwrite($fs, $http_request);
		while ( !feof($fs) ) {
			$response .= fgets($fs, 1160); // One TCP-IP packet
		}
		fclose($fs);

		$response = explode("\r\n\r\n", $response, 2);
	}

	return $response;
}

?>