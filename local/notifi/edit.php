<?php
/**
 * Version details
 *
 * @package    local_notifi
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 require_once(__DIR__ . '/../../config.php');
 require_once($CFG->dirroot . '/local/notifi/classes/form/edit.php');


 $PAGE->set_url(new moodle_url('/local/notifi/edit.php'));
 $PAGE->set_context(\context_system::instance());
 $PAGE->set_title('Edit');

 //to display our form
$mform = new edit();



if($mform->is_cancelled()){

    redirect($CFG->wwwroot . '/local/notifi/manage.php', 'You Cancelled the Notification form');
}elseif($formform = $mform->get_data()){

    $recordtoinsert= new stdClass();
    $recordtoinsert->notifitext = $formform->notifitext;
    $recordtoinsert->notifitype = $formform->notifitype;

    $DB->insert_record('local_notifi',$recordtoinsert);
    redirect($CFG->wwwroot . '/local/notifi/manage.php', 'You Created new Notification form' . $recordtoinsert->notifitext);


}



 echo $OUTPUT->header();
 $mform->display();
 echo $OUTPUT->footer();