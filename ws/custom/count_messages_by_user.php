<?php


require_once($CFG->libdir . "/externallib.php");

require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . "/mod/chat/lib.php");


class count_messages_by_user extends external_api
{

    public static function count_messages_parameters()
    {
        return new external_function_parameters(
            array(
                'chat_id' => new external_value(PARAM_INT, 'chat id,', VALUE_DEFAULT, '0'),
                'user_id' => new external_value(PARAM_INT, 'user id ,', VALUE_DEFAULT, '0'),
            )
        );
    }

    public static function count_messages($chat_id = '', $user_id = 1)
    {
        global $COURSE, $DB;

        self::validate_parameters(
            self::count_messages_parameters(),
            array('chat_id' => $chat_id, 'user_id' => $user_id)
        );

        $result = (int) $DB->count_records('chat_messages', array('chatid' => $chat_id, 'userid' => $user_id));

        return array('count' => $result);
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function count_messages_returns()
    {

        return new external_single_structure(
            array(
                'count' => new external_value(PARAM_INT, 'Number of messages.'),
            )
        );

        return new external_value(PARAM_TEXT, 'Number of chat messages by user');
    }
}
