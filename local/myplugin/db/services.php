<?php
// local/myplugin/externallib.php

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/externallib.php');

class local_myplugin_external extends external_api {

    /**
     * Returns description of method parameters.
     *
     * @return external_function_parameters
     */
    public static function edit_user_data_parameters() {
        return new external_function_parameters(
            array(
                'id' => new external_value(PARAM_INT, 'User ID'),
                'data' => new external_single_structure(
                    array(
                        'firstname' => new external_value(PARAM_TEXT, 'First Name'),
                        'lastname' => new external_value(PARAM_TEXT, 'Last Name'),
                        'email' => new external_value(PARAM_TEXT, 'Email Address'),
                        'phone' => new external_value(PARAM_TEXT, 'Phone Number'),
                    )
                ),
            )
        );
    }

    /**
     * Edit user data by ID.
     *
     * @param int $id User ID
     * @param array $data An array of data containing updated user information.
     * @return bool Whether the data was successfully updated or not.
     */
    public static function edit_user_data($id, $data) {
        global $DB;

        $user = $DB->get_record('user', array('id' => $id), '*', MUST_EXIST);

        // Validate and sanitize the data.
        $firstname = required_param($data['firstname'], PARAM_TEXT);
        $lastname = required_param($data['lastname'], PARAM_TEXT);
        $email = required_param($data['email'], PARAM_TEXT);
        $phone = optional_param($data['phone'], '', PARAM_TEXT);

        // Perform any additional validation or checks as needed.

        // Update the user fields.
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->email = $email;
        $user->phone = $phone;

        // Save the updated user record.
        if ($DB->update_record('user', $user)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Returns the description of the edit_user_data result value.
     *
     * @return external_description
     */
    public static function edit_user_data_returns() {
        return new external_single_structure(
            array(
                'success' => new external_value(PARAM_BOOL, 'Whether the update was successful or not.'),
            )
        );
    }

    // Define other API methods here if needed
}
