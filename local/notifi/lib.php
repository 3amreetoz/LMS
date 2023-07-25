<?php

/**
 * Version details
 *
 * @package    local_notifi
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function local_notifi_before_footer (){
   core\notification::add('hellow from the backend this is message to test the notifi in moodle new versrion',core\output\notification::NOTIFY_SUCCESS);
}