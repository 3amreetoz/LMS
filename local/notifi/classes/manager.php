<?php
// This file is part of Moodle Course Rollover Plugin
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


/**
 * @package     local_notifi
 * @author      Kristian
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_notifi;

use dml_exception;
use stdClass;

class manager {

    /** Insert the data into our database table.
     * @param string $notifi_text
     * @param string $notifi_type
     * @return bool true if successful
     */

     public function create_notifi(string $notifi_text, string $notifi_type): bool
     {
         global $DB;
         $record_to_insert = new stdClass();
         $record_to_insert->notifitext = $notifi_text;
         $record_to_insert->notifitype = $notifi_type;
         try {
             return $DB->insert_record('local_notifi', $record_to_insert, false);
         } catch (dml_exception $e) {
             return false;
         }
     }
       /** Gets all messages that have not been read by this user
     * @param int $userid the user that we are getting messages for
     * @return array of messages
     */
    public function get_notifis(int $userid): array
    {
        global $DB;
        $sql = "SELECT ln.id, ln.notifitext, ln.notifitype 
        FROM {local_notifi} ln 
        LEFT OUTER JOIN {local_notifi_read} lnr 
        ON ln.id = lnr.notifiid AND lnr.userid = :userid
        WHERE lnr.id IS NULL";
     
        $params=[
           'userid' => $userid,  
         
        ];
        
        try {
            return $DB->get_records_sql($sql, $params);
        } catch (dml_exception $e) {
            // Log error here.
            return [];
        }
    }

    // get all notifis
    public function get_all_notifis(): array {
        global $DB;
        return $DB->get_records('local_notifi');
    }

        /** Mark that a message was read by this user.
     * @param int $message_id the message to mark as read
     * @param int $userid the user that we are marking message read
     * @return bool true if successful
     */
    public function mark_notifi_read(int $notifi_id, int $userid): bool
    {
        global $DB;
        $readrecord= new stdClass();
        $readrecord->notifiid = $notifi_id;
        $readrecord->userid = $userid;
        $readrecord->timeread = time();
        try {
            return $DB->insert_record('local_notifi_read', $readrecord, false);
        } catch (dml_exception $e) {
            return false;
        }
    }

        /** Get a single message from its id.
     * @param int $messageid the message we're trying to get.
     * @return object|false message data or false if not found.
     */
    public function get_notifi(int $notifiid)
    {
        global $DB;
        return $DB->get_record('local_notifi', ['id' => $notifiid]);
    }


        public function get_notifi_data(int $id)
    {
        global $DB;
        $notifi = $DB->get_record('local_notifi', array('id' => $id), 'id,notifitext, notifitype');
    
        if (!$notifi) {
            throw new moodle_exception('Notifi not found');
        }

        return array(               
            'id' => $notifi->id,
            'notifitext' => $notifi->notifitext,
            'notifitype' => $notifi->notifitype,
        
        );    
    }


        /** Update details for a single message.
     * @param int $messageid the message we're trying to get.
     * @param string $message_text the new text for the message.
     * @param string $message_type the new type for the message.
     * @return bool message data or false if not found.
     */
    public function update_notifi(int $notifiid, string $notifi_text, string $notifi_type): bool
    {
        global $DB;
        $object = new stdClass();
        $object->id = $notifiid;
        $object->notifitext = $notifi_text;
        $object->notifitype = $notifi_type;
        return $DB->update_record('local_notifi', $object);
    }

    
    /** Delete a message and all the read history.
     * @param $messageid
     * @return bool
     * @throws \dml_transaction_exception
     * @throws dml_exception
     */
    public function delete_notifi($notifiid)
    {
        global $DB;
        $transaction = $DB->start_delegated_transaction();
        $deletednotifi = $DB->delete_records('local_notifi', ['id' => $notifiid]);
        $deletedRead = $DB->delete_records('local_notifi_read', ['notifiid' => $notifiid]);
        if ($deletednotifi && $deletedRead) {
            $DB->commit_delegated_transaction($transaction);
        }
        return true;
    }

}   