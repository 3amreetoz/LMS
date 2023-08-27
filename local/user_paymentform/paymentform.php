<?php

use local_user_paymentform\forms\paymentform;
use local_user_paymentform\manager;

require_once(__DIR__ . '/../../config.php');

require_once($CFG->dirroot . '/local/user_paymentform/externallib.php');    

$PAGE->set_url(new moodle_url('/local/user_paymentform/paymentform.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Payment Form');
$PAGE->set_heading('Payment Form');

$PAGE->requires->css('/local/user_paymentform/style.css');

$courseid = required_param('courseid', PARAM_INT);
$costandc = required_param('cost', PARAM_TEXT);
$coursename = required_param('coursename', PARAM_TEXT);

$cost = preg_replace('/[^0-9.]/', '', $costandc);
$currency = preg_replace('/[^a-zA-Z]/', '', $costandc);


$paramspind=[
    'courseid' => $courseid,
    'cost' => $cost,
    'coursename' => $coursename,
    'currency' => $currency,
];

// var_dump($paramspind);
// die();

$mform = new paymentform(null,$paramspind);
if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot . '/my/courses.php', 'You cancelled the Payment Form');
} elseif ($fromform = $mform->get_data()) {

    $manager = new manager();
  $create = $manager->create_payment(
        $fromform->firstname,
        $fromform->lastname,
        $fromform->email,
        $fromform->phone,
        $fromform->country,
        $fromform->certificatename,
        $fromform->courseid,
        $fromform->cost,
        $fromform->coursename,
        $fromform->currency,

    );
    // Send data to the receiving Moodle instance using the API
    $response = local_user_paymentform_external::send_data(
        // $fromform->username,
        $fromform->firstname,
        $fromform->lastname,
        $fromform->email,
        $fromform->phone,
        $fromform->country,
        $fromform->certificatename,
        $fromform->courseid,
        $fromform->cost,
        $fromform->coursename,
        $fromform->currency,
    );
}

echo $OUTPUT->header();
$mform->display();
echo $OUTPUT->footer();
