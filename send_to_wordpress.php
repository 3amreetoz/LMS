<?php
// send_to_wordpress.php

// Moodle API script to send form data to the WordPress project
$wordpress_api_url = 'http://localhost/hellow/';

// Your plugin form processing code here to get $username, $email, $phone, $encrypted_number

// Prepare the user data as an array
$user_data = array(
    'id' => $notifi->id,
    'notifitext' => $notifi->notifitext,
    'notifitype' => $notifi->notifitype,
    // Add more form fields as needed.
);

// Use cURL to send the data to the WordPress API
$ch = curl_init($wordpress_api_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($user_data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

// Handle the response if needed (e.g., log errors or process success message).
