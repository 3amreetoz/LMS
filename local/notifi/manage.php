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

$PAGE->set_url(new moodle_url('/local/notifi/manage.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Manage Notifications');

$notifi = $DB->get_records('local_notifi');

echo $OUTPUT->header();

$templatecontext = (object)[

    'notifi' => array_values($notifi),
    'editurl' => new moodle_url('/local/notifi/edit.php'),
];
    
echo $OUTPUT->render_from_template('local_notifi/manage',$templatecontext);

echo $OUTPUT->footer();
