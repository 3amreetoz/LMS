<?php
/**
 * Version details
 *
 * @package    local_notifi
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

//moodleform is defined in formslib.php
require_once("$CFG->libdir/formslib.php");

class simplehtml_form extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;
       
        $mform = $this->_form; // Don't forget the underscore! 

        $mform->addElement('text', 'email', get_string('email')); // Add elements to your form.
        $mform->setType('email', PARAM_NOTAGS);                   // Set type of element.
        $mform->setDefault('email', 'Please enter email');        // Default value.
            
    }
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}
