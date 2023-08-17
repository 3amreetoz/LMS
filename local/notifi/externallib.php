<?php

use local_notifi\manager;

require_once(__DIR__ . '/../../config.php'); // Adjust the path as needed
require_once($CFG->libdir . '/externallib.php');
require_once($CFG->dirroot . '/user/lib.php');
require_once($CFG->dirroot . '/course/lib.php');
// require_once($CFG->dirroot . '/local/notifi/classes/manager.php');
    
class local_notifi_external extends external_api {

    /**
     * Returns description of method parameters.
     *
     * @return external_function_parameters
     */
    public static function get_notifi_parameters() {
        return new external_function_parameters(
            array(
                'id' => new external_value(PARAM_INT, 'Notifi ID'),
            )
        );
    }

    /**
     * Get user data by ID.
     *
     * @param int $id User ID
     * @return array User data
     */
    public static function get_notifi($id) {
        $params = self::validate_parameters(self::get_notifi_parameters(), array('id'=>$id));

        require_capability('local/notifi:managenotifis', context_system::instance());

        $manager = new manager();
        return $manager->get_notifi_data($params['id']);
    }

    /**
     * Returns the description of the get_user_data result value.
     *
     * @return external_description
     */
    public static function get_notifi_returns() {
        return new external_single_structure(
            array(
                'id' => new external_value(PARAM_INT, 'User ID'),
                'notifitext' => new external_value(PARAM_TEXT, 'First Name'),
                'notifitype' => new external_value(PARAM_TEXT, 'Last Name'),   
            )
        );
    }
    

    // public static function send_notification_to_other_project($action, $notificationData) {
    //     global $CFG;
    //     // URL of the send_notification.php file created in step 1
    //     $apiUrl = $CFG->wwwroot . '/local/notifi/send_notification.php'; // Replace with the actual URL
    
    //     // Prepare the data to be sent in the POST request
    //     $postData = array(
    //         'action' => $action,
    //         'notification' => json_encode($notificationData),
    //     );
    
    //     // Make a POST request to the send_notification.php file (for testing)
    //     $ch = curl_init($apiUrl);
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     $response = curl_exec($ch);
    //     curl_close($ch);
    
    //     // Output the API response for testing
    //     echo "Test Response: " . $response . PHP_EOL;
    
    //     // In a real integration, you would handle the API response here instead of echoing it
    //     // You can use $response to check for success or handle errors accordingly
    // }

    public static function create_notifi_parameters() {
        return new external_function_parameters(
            array(
                'notifitext' => new external_value(PARAM_TEXT, 'Notification text'),
                'notifitype' => new external_value(PARAM_TEXT, 'Notification type'),
            )
        );
    }

    /**
     * Create a notification via API request.
     *
     * @param string $notifitext Notification text
     * @param string $notifitype Notification type
     * @return bool true if the notification is created successfully
     */
    
    public static function create_notifi($notifitext, $notifitype) {
        $params = self::validate_parameters(self::create_notifi_parameters(),
            array('notifitext' => $notifitext, 'notifitype' => $notifitype));

        // Create the notification using the manager class
        $manager = new manager();
        return $manager->create_notifi($params['notifitext'], $params['notifitype']);
    }


    /**
     * Returns description of method result value for the create_notifi API method.
     *
     * @return external_description
     */
    public static function create_notifi_returns() {
        return new external_value(PARAM_BOOL, 'True if the notification is created successfully.');
    }


   /**
     * Returns description of method parameters for the update_notifi API method.
     *
     * @return external_function_parameters
     */
    public static function update_notifi_parameters() {
        return new external_function_parameters(
            array(
                'id' => new external_value(PARAM_INT, 'Notification ID'),
                'notifitext' => new external_value(PARAM_TEXT, 'Notification Text'),
                'notifitype' => new external_value(PARAM_TEXT, 'Notification Type'),
            )
        );
    }

    /**
     * Update notification data via API request.
     *
     * @param int $notifiid Notification ID
     * @param string $notifitext New notification text
     * @param string $notifitype New notification type
     * @return bool True if the update was successful, false otherwise
     */
    public static function update_notifi($id, $notifitext, $notifitype) {
        $params = self::validate_parameters(self::update_notifi_parameters(), compact('id', 'notifitext', 'notifitype'));

        // Update the notification data using the manager class
        $manager = new manager();
        return $manager->update_notifi($params['id'], $params['notifitext'], $params['notifitype']);
    }

    /**
     * Returns description of method result value for the update_notifi API method.
     *
     * @return external_description
     */
    public static function update_notifi_returns() {
        return new external_value(PARAM_BOOL, 'True if the update was successful, false otherwise.');
    }


    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function delete_notifi_parameters() {
        return new external_function_parameters(
            ['id' => new external_value(PARAM_INT, 'id of message')],
        );
    }

    /**
     * The function itself
     * @return string welcome message
     */
    public static function delete_notifi($id): string {
        $params = self::validate_parameters(self::delete_notifi_parameters(), array('id'=>$id));

        require_capability('local/notifi:managenotifis', context_system::instance());

        $manager = new manager();
        return $manager->delete_notifi($params['id']);
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function delete_notifi_returns() {
        return new external_value(PARAM_BOOL, 'True if the message was successfully deleted.');
    }
}

