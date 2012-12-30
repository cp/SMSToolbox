<?php

function shortenurl($urltoshorten){
	//takes text and returns tinyurl
	$tiny = "http://tinyurl.com/api-create.php?url={$urltoshorten}";
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $tiny);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


	$output = curl_exec($ch);

	curl_close($ch);

	return $output

}