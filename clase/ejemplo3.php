<?php

$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => "https://linguatools-conjugations.p.rapidapi.com/conjugate/?verb=eat",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
		"x-rapidapi-host: linguatools-conjugations.p.rapidapi.com",
		"x-rapidapi-key: 797e09afc8msh4b5628dcea4509cp168248jsn0aebeaf84a5a"
	),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}