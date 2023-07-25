<?php
/**
 * Version details
 *
 * @package    local_notifi
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


require_once(__DIR__ . '/../../config.php');
$PAGE->set_url(new moodle_url('/local/notifi/manage.php'));
$PAGE->set_context(\context_system::instance());

$PAGE->set_title('Manage Notifications');

echo $OUTPUT->header();

$templatecontext = (object)[

    'texttodisplay' => 'here is some text',
];

echo $OUTPUT->render_from_template('local_notifi/manage',$templatecontext);

echo $OUTPUT->footer();
