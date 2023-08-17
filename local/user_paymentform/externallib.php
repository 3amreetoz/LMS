<?php

use core_external\external_api;
use core_external\external_function_parameters;
use core_external\external_single_structure;
use core_external\external_value;
use GuzzleHttp\Client;


require_once(__DIR__ . '/../../config.php'); // Adjust the path as needed
require_once($CFG->libdir . '/externallib.php');
require_once($CFG->dirroot . '/user/lib.php');


class local_user_paymentform_external extends external_api
{
    public static function send_data_parameters()
    {
        return new external_function_parameters(array(
                    // 'username' => new external_value(PARAM_TEXT, 'User Name'),
                    'firstname' => new external_value(PARAM_TEXT, 'First Name'),
                    'lastname' => new external_value(PARAM_TEXT, 'Last Name'),
                    'email' => new external_value(PARAM_EMAIL, 'Email'),
                    'phone' => new external_value(PARAM_RAW_TRIMMED, 'Phone'),
                    'country' => new external_value(PARAM_TEXT, 'Country'),
                    'certificatename' => new external_value(PARAM_TEXT, 'Certificate Name'),
                )
            
        );
    }

    /**
     * Create a notification via API request.
     *
     * @param array $data Array containing form data
     * @return mixed API response
     */
    public static function send_data( $firstname,  $lastname,  $email,  $phone,  $country,  $certificatename)
    {
        // $params = self::validate_parameters(
        //     self::send_data_parameters(),
        //     compact('firstname', 'lastname', 'email', 'phone', 'country', 'certificatename')
        // );     
$receiverUrl = 'http://localhost/apitest/moodle/webservice/rest/server.php';
$token = 'b3c257415918b7e3185556c5aa5a455a';
$functionName = 'local_getpayment_save_data';

$dataToSend = array(
    'wstoken' => $token,
    'wsfunction' => $functionName,
    'moodlewsrestformat' => 'json',
    // 'username' => $username,
    'firstname' => $firstname,
    'lastname' => $lastname,
    'email' => $email,
    'phone' => $phone,
    'country' => $country,
    'certificatename' => $certificatename,
);


$client = new Client();

try {
    $response = $client->post($receiverUrl, [
        'form_params' => $dataToSend,
        
    ] 
); 
$responseBody = $response->getBody()->getContents();
$responseData = json_decode($responseBody, true);

// var_dump($responseBody);
// die();

// Handle the response from the receiving project
if (isset($responseData['success'])) {
    if ($responseData['success']) {
     redirect(new moodle_url($responseData['urlredirect']));
        // echo 'Data sent successfully: ' . $responseData['message'];
    } else {
        echo 'Error: ' . $responseData['urlredirect'];
    }
} else {
    echo 'Unexpected response from receiving project';
}
    // Handle the response from the receiving project
} catch (\Exception $e) {
    echo $e->getMessage();
}

    }

public static function send_data_returns() {
    return new external_single_structure([
        'success' => new external_value(PARAM_BOOL, 'Whether the form processing was successful'),
    ]);
}
}
