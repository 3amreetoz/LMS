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
 * @package     local_user_paymentform
 * @author      Kristian
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_user_paymentform;

use dml_exception;
use stdClass;

class manager
{

    /** Insert the data into our database table.
     * @param string $notifi_text
     * @param string $notifi_type
     * @return bool true if successful
     */


    public function create_payment(string $firstname, string $lastname, string $email, string $phone, string $country, string $certificatename): bool
    {
        global $DB;
        $record_to_insert = new stdClass();
        // $record_to_insert->user_name = $username;
        $record_to_insert->first_name = $firstname;
        $record_to_insert->last_name = $lastname;
        $record_to_insert->email = $email;
        $record_to_insert->phone = $phone;
        $record_to_insert->country = $country;
        $record_to_insert->certificate_name = $certificatename;

        try {
            return $DB->insert_record('local_user_paymentform', $record_to_insert, false);
        } catch (dml_exception $e) {
            return false;
        }
    }
}
