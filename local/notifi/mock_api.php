<?php
// mock_api.php

// Simulate a simple mock API endpoint for testing purposes

// Set the content type to JSON
header('Content-Type: application/json');

// Define the mock response data
$mockResponse = array(
    'status' => 'success',
    'message' => 'Notification data received successfully.',
);

// Get the data sent by the API request (assuming it's a POST request)
$data = $_POST;

// Process the data and add it to the mock response (in this example, we simply return the mock response with the added data)
$mockResponse['data'] = $data;

// Display the mock response (including the data received in the API request)
echo json_encode($mockResponse);
