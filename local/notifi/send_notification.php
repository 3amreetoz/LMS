<?php
// send_notification.php

// Set the content type to JSON
header('Content-Type: application/json');

// Check if the required data is available in the POST request
if (!isset($_POST['action']) || !isset($_POST['notification'])) {
    echo json_encode(array('status' => 'error', 'message' => 'Required data missing.'));
    exit;
}

$action = $_POST['action'];
$notificationData = json_decode($_POST['notification'], true);

// Perform the required action based on the 'action' value
if ($action === 'create') {
    // Simulate creating the notification in the other app's system
    // You can use $notificationData to access the relevant data, e.g., $notificationData['notifitext'], $notificationData['notifitype']

    // Simulate a successful response
    $response = array(
        'status' => 'success',
        'message' => 'Notification created successfully.',
    );
} elseif ($action === 'update') {
    // Simulate updating the notification in the other app's system
    // You can use $notificationData to access the relevant data, e.g., $notificationData['id'], $notificationData['notifitext'], $notificationData['notifitype']

    // Simulate a successful response
    $response = array(
        'status' => 'success',
        'message' => 'Notification updated successfully.',
    );
} elseif ($action === 'delete') {
    // Simulate deleting the notification in the other app's system
    // You can use $notificationData to access the relevant data, e.g., $notificationData['id']

    // Simulate a successful response
    $response = array(
        'status' => 'success',
        'message' => 'Notification deleted successfully.',
    );
} else {
    // Invalid action
    $response = array(
        'status' => 'error',
        'message' => 'Invalid action specified.',
    );
}

// Output the API response
echo json_encode($response);
