<?php

use core_external\external_api;
use core_external\external_function_parameters;
use core_external\external_single_structure;
use core_external\external_value;
require_once(__DIR__ . '/../../config.php'); // Adjust the path as needed
require_once($CFG->libdir . '/externallib.php');
require_once($CFG->dirroot . '/user/lib.php');
require_once($CFG->dirroot . '/course/lib.php');

class local_user_data_api_external extends external_api {

    /**
     * Returns description of method parameters.
     *
     * @return external_function_parameters
     */
    public static function get_user_data_parameters() {
        return new external_function_parameters(
            array(
                'id' => new external_value(PARAM_INT, 'User ID'),
            )
        );
    }

    /**
     * Get user data by ID.
     *
     * @param int $id User ID
     * @return array User data
     */
    public static function get_user_data($id) {
        global $DB;

        $user = $DB->get_record('user_data_api', array('id' => $id), 'id, firstname, lastname, email, phone');

        if (!$user) {
            throw new moodle_exception('User not found');
        }

        return array(
            'id' => $user->id,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'email' => $user->email,
            'phone' => $user->phone,
        );
    }

    /**
     * Returns the description of the get_user_data result value.
     *
     * @return external_description
     */
    public static function get_user_data_returns() {
        return new external_single_structure(
            array(
                'id' => new external_value(PARAM_INT, 'User ID'),
                'firstname' => new external_value(PARAM_TEXT, 'First Name'),
                'lastname' => new external_value(PARAM_TEXT, 'Last Name'),
                'email' => new external_value(PARAM_TEXT, 'Email Address'),
                'phone' => new external_value(PARAM_TEXT, 'Phone Number'),
            )
        );
    }






    // create form
    public static function post_user_data_parameters() {
        return new external_function_parameters(
            array(
                'firstname' => new external_value(PARAM_TEXT, 'First name'),
                'lastname' => new external_value(PARAM_TEXT, 'Last name'),
                'email' => new external_value(PARAM_TEXT, 'Email address'),
                'phone' => new external_value(PARAM_TEXT, 'Phone number'),
            )
        );
    }

    public static function post_user_data($data) {
        global $DB;

        // Extract the parameters from the $data array
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $email = $data['email'];
        $phone = $data['phone'];

        // Validate the data (optional - add your own validation logic)

        // Create an associative array of data to be inserted into the database
        $new_user_data = array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'phone' => $phone,
        );

        // Insert the data into the 'user_data_api' table
        $id = $DB->insert_record('user_data_api', $new_user_data);

        if ($id) {
            return true; // Data inserted successfully
        } else {
            return false; // Failed to insert data
        } 
    }
    
    public static function post_user_data_returns() {
        // This method returns a description of the values that are returned by the `post_user_data()` method.
        // The `PARAM_INT_FIELD` constant is used to indicate that the `id` field is an integer field in the `user` table.
        return new external_single_structure(
            array(
                'firstname' => new external_value(PARAM_TEXT, 'First Name'),
                'lastname' => new external_value(PARAM_TEXT, 'Last Name'),
                'email' => new external_value(PARAM_TEXT, 'Email Address'),
                'phone' => new external_value(PARAM_TEXT, 'Phone Number'),
            )
        );
    }
    


    public static function edit_user_data_parameters() {
        return new external_function_parameters(
            array(
                'id' => new external_value(PARAM_INT, 'User ID'),
                'data' => new external_single_structure(
                    array(
                        'firstname' => new external_value(PARAM_TEXT, 'First name'),
                        'lastname' => new external_value(PARAM_TEXT, 'Last name'),
                        'email' => new external_value(PARAM_TEXT, 'Email address'),
                        'phone' => new external_value(PARAM_TEXT, 'Phone number'),
                    )
                ),
            )
        );
    }

    public static function edit_user_data($id, $data) {
        global $DB;

        // Validate and sanitize input data.
        $id = (int)$id;
        $firstname = required_param($data['firstname'], PARAM_TEXT);
        $lastname = required_param($data['lastname'], PARAM_TEXT);
        $email = required_param($data['email'], PARAM_TEXT);
        $phone = optional_param($data['phone'], '', PARAM_TEXT);

        // Fetch the existing user record from the database.
        $user = $DB->get_record('your_user_data_table', array('id' => $id), '*', MUST_EXIST);

        // Example of conditional logic based on parameters.
        if ($user->firstname !== $firstname) {
            // Perform specific actions when the firstname is changed.
            // For example, send an email notification about the change.
        }

        if ($user->email !== $email) {
            // Perform specific actions when the email is changed.
            // For example, verify the new email or update other related records.
        }

        // Update the user fields.
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->email = $email;
        $user->phone = $phone;

        // Save the updated user record.
        if ($DB->update_record('your_user_data_table', $user)) {
            return true;
        } else {
            return false;
        }
    }


    public static function edit_user_data_returns() {
        return new external_single_structure(
            array(
                'success' => new external_value(PARAM_BOOL, 'Whether the data was successfully updated or not.'),
            )
        );
    }

    /**
     * Returns description of method parameters.
     *
     * @return external_function_parameters
     */
    public static function delete_user_data_parameters() {
        return new external_function_parameters(
            array(
                'id' => new external_value(PARAM_INT, 'User ID'),
            )
        );
    }

    
      /**
     * Handles the API DELETE request to delete user data.
     *
     * @param int $id User ID
     * @return bool Whether the data was successfully deleted or not.
     */
    public static function delete_user_data($id) {
        global $DB;

        // Validate and sanitize input data.
        $id = (int)$id;

        // Fetch the existing user record from the database.
        $user = $DB->get_record('user_data_api', array('id' => $id), 'id');

        if (!$user) {
            throw new moodle_exception('User not found');
        }

        // Delete the user record.
        $result = $DB->delete_records('user_data_api', array('id' => $id));
            if($result) {
                $response = [
                    'message'=>'Success'                        
                    ];

            }else{
                $response = [
                    'message'=>'Failed'                        
                    ];

            }        
            
        return $response;
    }

    public static function delete_user_data_returns() {
        return new external_single_structure(
                array(                   
                    'message'=> new external_value(PARAM_TEXT, 'success message')                   
                )
            );
    }
    // Define other API methods here if needed
}

