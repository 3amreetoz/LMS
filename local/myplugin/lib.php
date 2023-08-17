<?php
// local/myplugin/lib.php

defined('MOODLE_INTERNAL') || die();

function local_myplugin_api_call($api_url, $data) {
    // Prepare the data for the API call. You may need to serialize it to JSON or use other formats.
    $params = http_build_query($data);

    // Set up the cURL session.
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL certificate verification (adjust this as needed).

    // Execute the API call and get the response.
    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    // Check for cURL errors.
    if ($error) {
        // Handle cURL error if needed.
        return false;
    }

    // Process the API response.
    // You may need to parse the response based on the format (e.g., JSON, XML, etc.).
    // For example, if the API returns JSON data:
    $response_data = json_decode($response, true);

    if ($response_data && isset($response_data['success']) && $response_data['success'] === true) {
        // API call was successful.
        return true;
    } else {
        // API call failed.
        return false;
    }
}
