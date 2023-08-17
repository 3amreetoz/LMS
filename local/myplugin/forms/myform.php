<?php
// local/myplugin/forms/myform.php

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');
require_once($CFG->dirroot . '/local/myplugin/lib.php'); // Include the custom library for API calls

class local_myplugin_myform extends moodleform {

    public function definition() {
        $mform = $this->_form;

        // Add form elements for collecting data from the user.
        $mform->addElement('text', 'firstname', get_string('firstname', 'local_myplugin'));
        $mform->setType('firstname', PARAM_TEXT);
        $mform->addRule('firstname', get_string('required'), 'required', null, 'client');

        $mform->addElement('text', 'lastname', get_string('lastname', 'local_myplugin'));
        $mform->setType('lastname', PARAM_TEXT);
        $mform->addRule('lastname', get_string('required'), 'required', null, 'client');

        // Add more elements for other fields as needed.
        // ...

        $this->add_action_buttons(true, get_string('submit', 'local_myplugin'));
    }

    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        // Perform additional validation here if needed.
        // For example, you can add custom validation rules for fields.

        return $errors;
    }

    public function definition_after_data() {
        global $CFG;

        if ($this->is_submitted() && $this->is_validated()) {
            $data = $this->get_data();

            // Prepare the data to be sent to the other project's API.
            $api_data = array(
                'firstname' => $data->firstname,
                'lastname' => $data->lastname,
                // Add other fields to the array as needed.
                // ...
            );

            // Make the API call to the other project's API endpoint.
            $response = local_myplugin_api_call('http://example.com/api/save_data', $api_data);

            // Handle the API response if needed.
            if ($response === true) {
                // The API call was successful. Display a success message.
                $this->_form->displayConfirmation(get_string('success_message', 'local_myplugin'));
            } else {
                // The API call failed. Display an error message.
                $this->_form->displayError(get_string('error_message', 'local_myplugin'));
            }
        }
    }
}
