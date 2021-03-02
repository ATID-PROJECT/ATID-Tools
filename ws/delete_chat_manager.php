<?php

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
 * External Web Service Template
 *
 * @package    localwstemplate
 * @copyright  2011 Moodle Pty Ltd (http://moodle.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once($CFG->libdir . "/externallib.php");
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . "/mod/chat/lib.php");

require_once($CFG->dirroot . '/calendar/lib.php');


class delete_chat_manager extends external_api
{

    /**
     * Returns description of method result value
     * @return external_function_parameters
     */
    public static function delete_chat_parameters()
    {
        return new external_function_parameters(
            array(
                'chat_id' => new external_value(PARAM_INT, 'chat id', VALUE_DEFAULT, 'Hello world, '),
            )
        );
    }

    public static function delete_chat($chat_id)
    {

        global $DB;


        if (!$chat = $DB->get_record('chat', array('id' => $chat_id))) {
            return false;
        }

        $result = true;
        $course_id = $chat->course;

        // Delete any dependent records here

        if (!$DB->delete_records('chat', array('id' => $chat->id))) {
            $result = false;
        }
        if (!$DB->delete_records('chat_messages', array('chatid' => $chat->id))) {
            $result = false;
        }
        if (!$DB->delete_records('chat_messages_current', array('chatid' => $chat->id))) {
            $result = false;
        }
        if (!$DB->delete_records('chat_users', array('chatid' => $chat->id))) {
            $result = false;
        }

        if (!$DB->delete_records('event', array('modulename' => 'chat', 'instance' => $chat->id))) {
            $result = false;
        }

        rebuild_course_cache($course_id);

        $result = array();
        $result['sucess'] = true;
        return $result;
    }

    public static function delete_chat_returns()
    {

        return new external_single_structure(
            array(
                'sucess' => new external_value(PARAM_BOOL, 'Whether the user can do the or not.'),
            )
        );
        return new external_value(PARAM_TEXT, 'The welcome message + user first name');
    }
}
