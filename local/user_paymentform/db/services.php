<?php
defined('MOODLE_INTERNAL') || die();
// Define your external API functions
$functions = array(
    'local_user_paymentform_send_data' => array(
        'classname' => 'local_user_paymentform_external',
        'methodname' => 'send_data',
        'description' => 'Send form data to receiving Moodle instance',
        'classpath'   => 'local/user_paymentform/externallib.php', 
        'type' => 'write',
        'capabilities' => '',
    ),
);
$services = array(
    'Local sendpaymentform' => array(
        'functions' => array(

            "local_user_paymentform_send_data"
        ),
        'restrictedusers' => 0,
        'enabled' => 1,
    ),
);
