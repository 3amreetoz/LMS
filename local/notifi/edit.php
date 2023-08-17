<?php
/**
 * Version details
 *
 * @package    local_notifi
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
use local_notifi\form\edit;
use local_notifi\manager;

 require_once(__DIR__ . '/../../config.php');
//  require_once($CFG->dirroot . '/local/notifi/classes/form/edit.php');
//  require_once($CFG->dirroot . '/local/notifi/classes/manager.php');

//  require_capability('local/notifi:managenotifis', $context);
require_login();
$context = context_system::instance();
require_capability('local/notifi:managenotifis', $context);
 $PAGE->set_url(new moodle_url('/local/notifi/edit.php'));
 $PAGE->set_context(\context_system::instance());
 $PAGE->requires->css('/local/notifi/styles.css');

 $PAGE->set_title('Edit');

 $notifiid = optional_param('notifiid', null, PARAM_INT);


 //to display our form
$mform = new edit();

if($mform->is_cancelled()){

    redirect($CFG->wwwroot . '/local/notifi/manage.php', 'You Cancelled the Notification form');
}elseif($fromform = $mform->get_data()){
   $manager = new manager();

   if ($fromform->id) {
    // We are updating an existing message.
    $manager->update_notifi($fromform->id, $fromform->notifitext, $fromform->notifitype);
    redirect($CFG->wwwroot . '/local/notifi/manage.php','updated form'. $fromform->notifitext);
}

   $manager->create_notifi($fromform->notifitext, $fromform->notifitype);
       // Go back to manage.php page
       redirect($CFG->wwwroot . '/local/notifi/manage.php','form created'. $fromform->notifitext);   
}

if ($notifiid) {
    // Add extra data to the form.
    global $DB;
    $manager = new manager();
    $notifi = $manager->get_notifi($notifiid);
    if (!$notifi) {
        throw new invalid_parameter_exception('Notifi not found');
    }
    $mform->set_data($notifi);
}

 echo $OUTPUT->header();
 $mform->display();
 echo $OUTPUT->footer();