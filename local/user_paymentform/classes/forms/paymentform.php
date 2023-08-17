<?php

/**
 * Version details
 *
 * @package    local_user_paymentform
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_user_paymentform\forms;

use moodleform;

//moodleform is defined in formslib.php
require_once("$CFG->libdir/formslib.php");

class paymentform extends moodleform
{
    //Add elements to form
    public function definition()
    {
        global $CFG;

        $mform = $this->_form; // Don't forget the underscore! 
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

 
        $mform->addElement('text', 'firstname', 'First Name');
        $mform->setType('firstname', PARAM_TEXT);
        $mform->addRule('firstname', 'Please enter First Name', 'required', null, 'client');
        $mform->addRule('firstname', 'First Name must be between 2 and 50 characters', 'minlength', 2, 'client');
        $mform->addRule('firstname', 'First Name must be between 2 and 50 characters', 'maxlength', 50, 'client');

        $firstnameElement = $mform->getElement('firstname');
        $firstnameElement->updateAttributes(array('placeholder' => 'Please enter First Name'));

        $mform->addElement('text', 'lastname', 'Last Name');
        $mform->setType('lastname', PARAM_TEXT);
        $mform->addRule('lastname', 'Please enter Last Name', 'required', null, 'client');
        $mform->addRule('lastname', 'Last Name must be between 2 and 50 characters', 'minlength', 2, 'client');
        $mform->addRule('lastname', 'Last Name must be between 2 and 50 characters', 'maxlength', 50, 'client');

        $lastnameElement = $mform->getElement('lastname');
        $lastnameElement->updateAttributes(array('placeholder' => 'Please enter Last Name'));

        // ... Repeat the above for other form elements (email and phone)
        
        // $mform->addElement('hidden', 'username');
        // $mform->setType('username', PARAM_TEXT);
        // $mform->addRule('username', null, 'client');

        $mform->addElement('text', 'email', 'Email');
        $mform->setType('email', PARAM_EMAIL);
        $mform->addRule('email', 'Please enter a valid Email', 'required', null, 'client');
        $mform->addRule('email', 'Please enter a valid Email', 'email', null, 'client');

        $emailElement = $mform->getElement('email');
        $emailElement->updateAttributes(array('placeholder' => 'name@gmail.com'));

        $mform->addElement('text', 'phone', 'Phone');
        $mform->setType('phone', PARAM_RAW_TRIMMED);
        $mform->addRule('phone', 'Please enter Phone', 'required', null, 'client');
        $mform->addRule('phone', 'Please enter a valid Phone number', 'regex', '/^\+?[0-9\s()-]+$/', 'client');

        $phoneElement = $mform->getElement('phone');
        $phoneElement->updateAttributes(array('placeholder' => 'Please enter Phone'));




        $countryNames = array(
            '' => 'Select Country',
            'Afghanistan' => 'Afghanistan',
            'Aland Islands' => 'Aland Islands',
            'Albania' => 'Albania',
            'Algeria' => 'Algeria',
            'American Samoa' => 'American Samoa',
            'Andorra' => 'Andorra',
            'Angola' => 'Angola',
            'Anguilla' => 'Anguilla',
            'Antarctica' => 'Antarctica',
            'Antigua and Barbuda' => 'Antigua and Barbuda',
            'Argentina' => 'Argentina',
            'Armenia' => 'Armenia',
            'Aruba' => 'Aruba',
            'Australia' => 'Australia',
            'Austria' => 'Austria',
            'Azerbaijan' => 'Azerbaijan',
            'Bahamas' => 'Bahamas',
            'Bahrain' => 'Bahrain',
            'Bangladesh' => 'Bangladesh',
            'Barbados' => 'Barbados',
            'Belarus' => 'Belarus',
            'Belgium' => 'Belgium',
            'Belize' => 'Belize',
            'Benin' => 'Benin',
            'Bermuda' => 'Bermuda',
            'Bhutan' => 'Bhutan',
            'Bolivia' => 'Bolivia',
            'Bonaire, Sint Eustatius and Saba' => 'Bonaire, Sint Eustatius and Saba',
            'Bosnia and Herzegovina' => 'Bosnia and Herzegovina',
            'Botswana' => 'Botswana',
            'Bouvet Island' => 'Bouvet Island',
            'Brazil' => 'Brazil',
            'British Indian Ocean Territory' => 'British Indian Ocean Territory',
            'Brunei Darussalam' => 'Brunei Darussalam',
            'Bulgaria' => 'Bulgaria',
            'Burkina Faso' => 'Burkina Faso',
            'Burundi' => 'Burundi',
            'Cambodia' => 'Cambodia',
            'Cameroon' => 'Cameroon',
            'Canada' => 'Canada',
            'Cape Verde' => 'Cape Verde',
            'Cayman Islands' => 'Cayman Islands',
            'Central African Republic' => 'Central African Republic',
            'Chad' => 'Chad',
            'Chile' => 'Chile',
            'China' => 'China',
            'Christmas Island' => 'Christmas Island',
            'Cocos (Keeling) Islands' => 'Cocos (Keeling) Islands',
            'Colombia' => 'Colombia',
            'Comoros' => 'Comoros',
            'Congo' => 'Congo',
            'Congo, Democratic Republic of the Congo' => 'Congo, Democratic Republic of the Congo',
            'Cook Islands' => 'Cook Islands',
            'Costa Rica' => 'Costa Rica',
            'Cote D\'Ivoire' => 'Cote D\'Ivoire',
            'Croatia' => 'Croatia',
            'Cuba' => 'Cuba',
            'Curacao' => 'Curacao',
            'Cyprus' => 'Cyprus',
            'Czech Republic' => 'Czech Republic',
            'Denmark' => 'Denmark',
            'Djibouti' => 'Djibouti',
            'Dominica' => 'Dominica',
            'Dominican Republic' => 'Dominican Republic',
            'Ecuador' => 'Ecuador',
            'Egypt' => 'Egypt',
            'El Salvador' => 'El Salvador',
            'Equatorial Guinea' => 'Equatorial Guinea',
            'Eritrea' => 'Eritrea',
            'Estonia' => 'Estonia',
            'Ethiopia' => 'Ethiopia',
            'Falkland Islands (Malvinas)' => 'Falkland Islands (Malvinas)',
            'Faroe Islands' => 'Faroe Islands',
            'Fiji' => 'Fiji',
            'Finland' => 'Finland',
            'France' => 'France',
            'French Guiana' => 'French Guiana',
            'French Polynesia' => 'French Polynesia',
            'French Southern Territories' => 'French Southern Territories',
            'Gabon' => 'Gabon',
            'Gambia' => 'Gambia',
            'Georgia' => 'Georgia',
            'Germany' => 'Germany',
            'Ghana' => 'Ghana',
            'Gibraltar' => 'Gibraltar',
            'Greece' => 'Greece',
            'Greenland' => 'Greenland',
            'Grenada' => 'Grenada',
            'Guadeloupe' => 'Guadeloupe',
            'Guam' => 'Guam',
            'Guatemala' => 'Guatemala',
            'Guernsey' => 'Guernsey',
            'Guinea' => 'Guinea',
            'Guinea-Bissau' => 'Guinea-Bissau',
            'Guyana' => 'Guyana',
            'Haiti' => 'Haiti',
            'Heard Island and Mcdonald Islands' => 'Heard Island and Mcdonald Islands',
            'Holy See (Vatican City State)' => 'Holy See (Vatican City State)',
            'Honduras' => 'Honduras',
            'Hong Kong' => 'Hong Kong',
            'Hungary' => 'Hungary',
            'Iceland' => 'Iceland',
            'India' => 'India',
            'Indonesia' => 'Indonesia',
            'Iran, Islamic Republic of' => 'Iran, Islamic Republic of',
            'Iraq' => 'Iraq',
            'Ireland' => 'Ireland',
            'Isle of Man' => 'Isle of Man',
            'Israel' => 'Israel',
            'Italy' => 'Italy',
            'Jamaica' => 'Jamaica',
            'Japan' => 'Japan',
            'Jersey' => 'Jersey',
            'Jordan' => 'Jordan',
            'Kazakhstan' => 'Kazakhstan',
            'Kenya' => 'Kenya',
            'Kiribati' => 'Kiribati',
            'Korea, Democratic People\'s Republic of' => 'Korea, Democratic People\'s Republic of',
            'Korea, Republic of' => 'Korea, Republic of',
            'Kosovo' => 'Kosovo',
            'Kuwait' => 'Kuwait',
            'Kyrgyzstan' => 'Kyrgyzstan',
            'Lao People\'s Democratic Republic' => 'Lao People\'s Democratic Republic',
            'Latvia' => 'Latvia',
            'Lebanon' => 'Lebanon',
            'Lesotho' => 'Lesotho',
            'Liberia' => 'Liberia',
            'Libyan Arab Jamahiriya' => 'Libyan Arab Jamahiriya',
            'Liechtenstein' => 'Liechtenstein',
            'Lithuania' => 'Lithuania',
            'Luxembourg' => 'Luxembourg',
            'Macao' => 'Macao',
            'Macedonia, the Former Yugoslav Republic of' => 'Macedonia, the Former Yugoslav Republic of',
            'Madagascar' => 'Madagascar',
            'Malawi' => 'Malawi',
            'Malaysia' => 'Malaysia',
            'Maldives' => 'Maldives',
            'Mali' => 'Mali',
            'Malta' => 'Malta',
            'Marshall Islands' => 'Marshall Islands',
            'Martinique' => 'Martinique',
            'Mauritania' => 'Mauritania',
            'Mauritius' => 'Mauritius',
            'Mayotte' => 'Mayotte',
            'Mexico' => 'Mexico',
            'Micronesia, Federated States of' => 'Micronesia, Federated States of',
            'Moldova, Republic of' => 'Moldova, Republic of',
            'Monaco' => 'Monaco',
            'Mongolia' => 'Mongolia',
            'Montenegro' => 'Montenegro',
            'Montserrat' => 'Montserrat',
            'Morocco' => 'Morocco',
            'Mozambique' => 'Mozambique',
            'Myanmar' => 'Myanmar',
            'Namibia' => 'Namibia',
            'Nauru' => 'Nauru',
            'Nepal' => 'Nepal',
            'Netherlands' => 'Netherlands',
            'Netherlands Antilles' => 'Netherlands Antilles',
            'New Caledonia' => 'New Caledonia',
            'New Zealand' => 'New Zealand',
            'Nicaragua' => 'Nicaragua',
            'Niger' => 'Niger',
            'Nigeria' => 'Nigeria',
            'Niue' => 'Niue',
            'Norfolk Island' => 'Norfolk Island',
            'Northern Mariana Islands' => 'Northern Mariana Islands',
            'Norway' => 'Norway',
            'Oman' => 'Oman',
            'Pakistan' => 'Pakistan',
            'Palau' => 'Palau',
            'Palestinian Territory, Occupied' => 'Palestinian Territory, Occupied',
            'Panama' => 'Panama',
            'Papua New Guinea' => 'Papua New Guinea',
            'Paraguay' => 'Paraguay',
            'Peru' => 'Peru',
            'Philippines' => 'Philippines',
            'Pitcairn' => 'Pitcairn',
            'Poland' => 'Poland',
            'Portugal' => 'Portugal',
            'Puerto Rico' => 'Puerto Rico',
            'Qatar' => 'Qatar',
            'Reunion' => 'Reunion',
            'Romania' => 'Romania',
            'Russian Federation' => 'Russian Federation',
            'Rwanda' => 'Rwanda',
            'Saint Barthelemy' => 'Saint Barthelemy',
            'Saint Helena' => 'Saint Helena',
            'Saint Kitts and Nevis' => 'Saint Kitts and Nevis',
            'Saint Lucia' => 'Saint Lucia',
            'Saint Martin' => 'Saint Martin',
            'Saint Pierre and Miquelon' => 'Saint Pierre and Miquelon',
            'Saint Vincent and the Grenadines' => 'Saint Vincent and the Grenadines',
            'Samoa' => 'Samoa',
            'San Marino' => 'San Marino',
            'Sao Tome and Principe' => 'Sao Tome and Principe',
            'Saudi Arabia' => 'Saudi Arabia',
            'Senegal' => 'Senegal',
            'Serbia' => 'Serbia',
            'Serbia and Montenegro' => 'Serbia and Montenegro',
            'Seychelles' => 'Seychelles',
            'Sierra Leone' => 'Sierra Leone',
            'Singapore' => 'Singapore',
            'Sint Maarten' => 'Sint Maarten',
            'Slovakia' => 'Slovakia',
            'Slovenia' => 'Slovenia',
            'Solomon Islands' => 'Solomon Islands',
            'Somalia' => 'Somalia',
            'South Africa' => 'South Africa',
            'South Georgia and the South Sandwich Islands' => 'South Georgia and the South Sandwich Islands',
            'South Sudan' => 'South Sudan',
            'Spain' => 'Spain',
            'Sri Lanka' => 'Sri Lanka',
            'Sudan' => 'Sudan',
            'Suriname' => 'Suriname',
            'Svalbard and Jan Mayen' => 'Svalbard and Jan Mayen',
            'Swaziland' => 'Swaziland',
            'Sweden' => 'Sweden',
            'Switzerland' => 'Switzerland',
            'Syrian Arab Republic' => 'Syrian Arab Republic',
            'Taiwan, Province of China' => 'Taiwan, Province of China',
            'Tajikistan' => 'Tajikistan',
            'Tanzania, United Republic of' => 'Tanzania, United Republic of',
            'Thailand' => 'Thailand',
            'Timor-Leste' => 'Timor-Leste',
            'Togo' => 'Togo',
            'Tokelau' => 'Tokelau',
            'Tonga' => 'Tonga',
            'Trinidad and Tobago' => 'Trinidad and Tobago',
            'Tunisia' => 'Tunisia',
            'Turkey' => 'Turkey',
            'Turkmenistan' => 'Turkmenistan',
            'Turks and Caicos Islands' => 'Turks and Caicos Islands',
            'Tuvalu' => 'Tuvalu',
            'Uganda' => 'Uganda',
            'Ukraine' => 'Ukraine',
            'United Arab Emirates' => 'United Arab Emirates',
            'United Kingdom' => 'United Kingdom',
            'United States' => 'United States',
            'United States Minor Outlying Islands' => 'United States Minor Outlying Islands',
            'Uruguay' => 'Uruguay',
            'Uzbekistan' => 'Uzbekistan',
            'Vanuatu' => 'Vanuatu',
            'Venezuela' => 'Venezuela',
            'Viet Nam' => 'Viet Nam',
            'Virgin Islands, British' => 'Virgin Islands, British',
            'Virgin Islands, U.s.' => 'Virgin Islands, U.s.',
            'Wallis and Futuna' => 'Wallis and Futuna',
            'Western Sahara' => 'Western Sahara',
            'Yemen' => 'Yemen',
            'Zambia' => 'Zambia',
            'Zimbabwe' => 'Zimbabwe'
        );

        $mform->addElement('select', 'country', 'Country', $countryNames);
        $mform->addRule('country', 'Please select a country', 'required', null, 'client');
        $mform->setDefault('country', ''); // Set the default selected value if needed

        $mform->addElement('text', 'certificatename', 'certificatename'); // Add elements to your form.
        $mform->setType('certificatename', PARAM_NOTAGS);                   // Set type of element.
        $mform->addRule('certificatename', 'Please enter certificate name', 'required', null, 'client');
        $mform->addRule('certificatename', 'certificate name must be between 2 and 50 characters', 'minlength', 2, 'client');
        $mform->addRule('certificatename', 'certificate name must be between 2 and 50 characters', 'maxlength', 50, 'client');

        $certificateName = $mform->getElement('certificatename');
        $certificateName->updateAttributes(array('placeholder' => 'Please enter certificate name'));
        $this->add_action_buttons();
    }
    // in case we want to create a generated username
    // Custom validation should be added here
//     function validation($data, $files)
//     {
//         global $DB;

//         $errors = parent::validation($data, $files);
// // Generate a username from first and last names
// $generatedUsername = strtolower(substr($data['firstname'], 0, 1) . $data['lastname']);


// // Check for uniqueness of the generated username
// $counter = 1;
// $originalUsername = $generatedUsername;
// while ($DB->record_exists_select('local_user_paymentform', "user_name = :username", ['username' => $generatedUsername])) {
//     $generatedUsername = $originalUsername . $counter;
//     $counter++;
// }

// // Set the generated username
// $data['username'] = $generatedUsername;


    
//         return $errors;
    
//     }
function validation($data, $files) {

    return array();
}
}
