<?php
defined('MOODLE_INTERNAL') || die();

$functions = array(
    'local_user_data_api_get_user_data' => array(
        'classname' => 'local_user_data_api_external',
        'methodname' => 'get_user_data',
        'classpath' => 'local/user_data_api/externallib.php',
        'description' => 'Get user data by ID.',
        'type' => 'read',
        'ajax' => true,
    ),
    'local_user_data_api_edit_user_data' => array(
        'classname' => 'local_user_data_api_external',
        'methodname' => 'edit_user_data',
        'classpath' => 'local/user_data_api/externallib.php',
        'description' => 'Edit user data by ID.',
        'type' => 'write',
        'ajax' => true,
    ),
    'local_user_data_api_post_user_data' => array(
        'classname' => 'local_user_data_api_external',
        'methodname' => 'post_user_data',
        'classpath' => 'local/user_data_api/externallib.php',
        'description' => 'create user data by ID.',
        'type' => 'write',
        'ajax' => true,
    ),
    'local_user_data_api_delete_user_data' => array(
        'classname' => 'local_user_data_api_external',
        'methodname' => 'delete_user_data',
        'classpath' => 'local/user_data_api/externallib.php',
        'description' => 'delete user data by ID.',
        'type' => 'write',
        'ajax' => true,
    ),
);

$services = array(
    'Local User Data API' => array(
        'functions' => array(
            'local_user_data_api_get_user_data',
            'local_user_data_api_edit_user_data',
            'local_user_data_api_post_user_data',
            'local_user_data_api_delete_user_data'
        ),
        'restrictedusers' => 0,
        'enabled' => 1,
    ),
);
