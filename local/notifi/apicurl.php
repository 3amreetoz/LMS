<?php

header('Content-Type: application/json');
$wstocken = "wstoken=a77843a2163309570c3eb49191c69133";
$wsfunction= "&wsfunction=local_notifi_get_notifi";



$apiUrl = "http://localhost/57/lms/webservice/rest/server.php?".  $wstocken  . $wsfunction ."&moodlewsrestformat=json&id=2";

$curl = curl_init($apiUrl);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);

if ($response === false) {
    echo "cURL Error: " . curl_error($curl);
}

curl_close($curl);

$data = json_decode($response, true);

// Now you can use $data, which will contain the JSON response as an associative array
print_r($data);
