<?php

/**
 * Version details
 *
 * @package    local_notifi
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
function local_notifi_before_footer (){

   global $DB,$USER;

   $sql = "SELECT ln.id, ln.notifitext, ln.notifitype FROM {local_notifi} ln 
   LEFT OUTER JOIN {local_notifi_read} lnr 
   ON ln.id = lnr.notifiid AND lnr.userid = :userid
   WHERE lnr.id IS NULL";

   $params=[
      'userid' => $USER->id ,  
    
   ];
   
   $notifis = $DB->get_records_sql($sql,$params);
   

   foreach($notifis as $notifi){
      if($notifi->notifitype === '1'){ 
         $type = core\output\notification::NOTIFY_INFO;

      }elseif($notifi->notifitype === '2'){
         $type = core\output\notification::NOTIFY_ERROR;

      }elseif($notifi->notifitype === '3'){
         $type = core\output\notification::NOTIFY_WARNING;

      }elseif($notifi->notifitype === '0'){
         $type = core\output\notification::NOTIFY_SUCCESS;

      }
   core\notification::add($notifi->notifitext,$type);


      $readrecord= new stdClass();
      $readrecord->notifiid = $notifi->id;
      $readrecord->userid = $USER->id;
      $readrecord->timeread = time();

      $DB->insert_record('local_notifi_read',$readrecord);
   }

}