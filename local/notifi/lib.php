<?php

/**
 * Version details
 *
 * @package    local_notifi
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
use local_notifi\manager;
//  require_once($CFG->dirroot . '/local/notifi/classes/manager.php');

function local_notifi_before_footer (){

   global $USER;


   
   if (!get_config('local_notifi', 'enabled')) {
      return;
  }
 
   $manager= new manager();
   $notifis = $manager->get_notifis($USER->id);


   foreach($notifis as $notifi){
      switch($notifi->notifitype){
         case '0':
            $type = core\output\notification::NOTIFY_SUCCESS;
            break;
         case '1':
            $type = core\output\notification::NOTIFY_INFO;
            break;
         case '2':
            $type = core\output\notification::NOTIFY_ERROR;
            break;
            case '3':
               $type = core\output\notification::NOTIFY_WARNING;
            break;
      }
   core\notification::add($notifi->notifitext,$type);

   $manager->mark_notifi_read($notifi->id,$USER->id);
    

   }

}