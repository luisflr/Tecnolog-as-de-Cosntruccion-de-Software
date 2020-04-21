<?php
$filecontents = file_get_contents('palabras.txt');
$palabras = preg_split('/[\s]+/', $filecontents, -1, PREG_SPLIT_NO_EMPTY); 
$url = 'https://linguatools-conjugations.p.rapidapi.com/conjugate/';
foreach  ($palabras as $key => $value){
    $request_url = $url . '?verb=' . $value;
    $curl = curl_init($request_url);
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            'x-rapidapi-host: linguatools-conjugations.p.rapidapi.com',
            'x-rapidapi-key: 797e09afc8msh4b5628dcea4509cp168248jsn0aebeaf84a5a'
        ),
    ));
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    
    $result = json_decode($response);
    
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo json_encode($result);
    }
    next($palabras);
}
?>
