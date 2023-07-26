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

class edit extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;
       
        $mform = $this->_form; // Don't forget the underscore! 
        $choices = array();
        $choices['0'] =\core\output\notification::NOTIFY_SUCCESS;
        $choices['1'] =\core\output\notification::NOTIFY_INFO;
        $choices['2'] =\core\output\notification::NOTIFY_ERROR;
        $choices['3'] =\core\output\notification::NOTIFY_WARNING;

        $mform->addElement('text', 'notifitext','notifitext'); // Add elements to your form.
        $mform->setType('notifitext', PARAM_NOTAGS);                   // Set type of element.
        $mform->setDefault('notifitext', 'pls enter notifitext');        // Default value.
        $mform->addElement('select', 'notifitype','notifi type', $choices);
        $mform->setDefault('notifitype', '3'); 

        $this->add_action_buttons();
    }
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}
