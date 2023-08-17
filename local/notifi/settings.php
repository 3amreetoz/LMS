<?php

if ($hassiteconfig) { // needs this condition or there is error on login page

    $ADMIN->add('localplugins', new admin_category('local_notifi_category','local notifi'));

    $settings = new admin_settingpage('local_notifi', 'local notifi');
    $ADMIN->add('local_notifi_category', $settings);

    $settings->add(new admin_setting_configcheckbox('local_notifi/enabled',
        'setting_enable','setting_enable_desc', '1'));

    $ADMIN->add('local_notifi_category', new admin_externalpage('local_notifi_manage','manage',
        $CFG->wwwroot . '/local/notifi/manage.php'));
}
