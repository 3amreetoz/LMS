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

// Display our form
$mform = new paymentform();

if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot . '/my/courses.php', 'You cancelled the Payment Form');
} elseif ($fromform = $mform->get_data()) {
    $manager = new manager();
    $manager->create_payment($fromform->firstname, $fromform->lastname, $fromform->email, $fromform->phone, $fromform->country, $fromform->certificatename);

    // Send data to the receiving Moodle instance using the API
      $response = local_user_paymentform_external::send_data(
        // $fromform->username,
        $fromform->firstname,
        $fromform->lastname,
        $fromform->email,
        $fromform->phone,
        $fromform->country,
        $fromform->certificatename
    );
    // if (200 == $response->getStatusCode()) {
    //     $body = $response->getBody();
    //     $arr_body = json_decode($body);
    //     print_r($arr_body);
    // }

}   

echo $OUTPUT->header();
$mform->display();
echo $OUTPUT->footer();
