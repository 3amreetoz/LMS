<?php
/**
 * Version details
 *
 * @package    local_notifi
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


require_once(__DIR__ . '/../../config.php');

global $DB;

require_login();
$context = context_system::instance();
require_capability('local/notifi:managenotifis', $context);

$PAGE->set_url(new moodle_url('/local/notifi/manage.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_heading('Manage Notifis');
$PAGE->set_title('Manage Notifications');
$PAGE->requires->js_call_amd('local_notifi/confirm');
$PAGE->requires->css('/local/notifi/styles.css');

$notifis = $DB->get_records('local_notifi',null,'id');

echo $OUTPUT->header();

$templatecontext = (object)[

    'notifi' => array_values($notifis),
    'editurl' => new moodle_url('/local/notifi/edit.php'),
    'bulkediturl' => new moodle_url('/local/notifi/bulkedit.php'),
];
    
echo $OUTPUT->render_from_template('local_notifi/manage',$templatecontext);

echo $OUTPUT->footer();
