<?php


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
