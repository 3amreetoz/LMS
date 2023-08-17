<?php
defined('MOODLE_INTERNAL') || die();

$functions = array(
    'local_notifi_get_notifi' => array(
        'classname' => 'local_notifi_external',
        'methodname' => 'get_notifi',
        'classpath' => 'local/notifi/externallib.php',
        'description' => 'Get notifi data by ID.',
        'type' => 'read',
        'ajax' => true,
    ),
    'local_notifi_delete_notifi' => array(         //web service function name
        'classname'   => 'local_notifi_external',  //class containing the external function OR namespaced class in classes/external/XXXX.php
        'methodname'  => 'delete_notifi',          //external function name
        'classpath'   => 'local/notifi/externallib.php',  //file containing the class/external function - not required if using namespaced auto-loading classes.
        'description' => 'Deletes a notifi',    //human readable description of the web service function
        'type'        => 'write',                  //database rights of the web service function (read, write)
        'ajax' => true,        // is the service available to 'internal' ajax calls.
        'capabilities' => '', // comma separated list of capabilities used by the function.
    ),
    'local_notifi_create_notifi' => array(         //web service function name
        'classname'   => 'local_notifi_external',  //class containing the external function OR namespaced class in classes/external/XXXX.php
        'methodname'  => 'create_notifi',          //external function name
        'classpath'   => 'local/notifi/externallib.php',  //file containing the class/external function - not required if using namespaced auto-loading classes.
        'description' => 'Create a notifi',    //human readable description of the web service function
        'type'        => 'write',                  //database rights of the web service function (read, write)
        'ajax' => true,        // is the service available to 'internal' ajax calls.
        'capabilities' => '', // comma separated list of capabilities used by the function.
    ),
    'local_notifi_update_notifi' => array(         //web service function name
        'classname'   => 'local_notifi_external',  //class containing the external function OR namespaced class in classes/external/XXXX.php
        'methodname'  => 'update_notifi',          //external function name
        'classpath'   => 'local/notifi/externallib.php',  //file containing the class/external function - not required if using namespaced auto-loading classes.
        'description' => 'Create a notifi',    //human readable description of the web service function
        'type'        => 'write',                  //database rights of the web service function (read, write)
        'ajax' => true,        // is the service available to 'internal' ajax calls.
        'capabilities' => '', // comma separated list of capabilities used by the function.
    ),
    'local_notifi_send_notification_to_other_project' => array(         //web service function name
        'classname'   => 'local_notifi_external',  //class containing the external function OR namespaced class in classes/external/XXXX.php
        'methodname'  => 'send_notification_to_other_project',          //external function name
        'classpath'   => 'local/notifi/externallib.php',  //file containing the class/external function - not required if using namespaced auto-loading classes.
        'description' => 'Create a notifi',    //human readable description of the web service function
        'type'        => 'write',                  //database rights of the web service function (read, write)
        'ajax' => true,        // is the service available to 'internal' ajax calls.
        'capabilities' => '', // comma separated list of capabilities used by the function.
    ),
    
);

$services = array(
    'Local Notifi' => array(
        'functions' => array(
            'local_notifi_get_notifi','local_notifi_delete_notifi','local_notifi_create_notifi','local_notifi_update_notifi','local_notifi_send_notification_to_other_project'

        ),
        'restrictedusers' => 0,
        'enabled' => 1,
    ),
);
