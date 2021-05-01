<?php


require_once($CFG->libdir . "/externallib.php");
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . "/mod/choice/lib.php");

require_once($CFG->dirroot . '/calendar/lib.php');


class delete_choice_manager extends external_api
{

    /**
     * Returns description of method result value
     * @return external_function_parameters
     */
    public static function delete_choice_parameters()
    {
        return new external_function_parameters(
            array(
                'choice_id' => new external_value(PARAM_INT, 'choice id', VALUE_DEFAULT, 'Hello world, '),
            )
        );
    }

    public static function delete_choice($choice_id)
    {

        global $DB;


        if (!$choice = $DB->get_record('choice', array('id' => $choice_id))) {
            return false;
        }

        $result = true;
        $course_id = $choice->course;

        // Delete any dependent records here

        if (!$DB->delete_records('choice', array('id' => $choice->id))) {
            $result = false;
        }
        if (!$DB->delete_records('choice_options', array('choiceid' => $choice->id))) {
            $result = false;
        }
        if (!$DB->delete_records('choice_answers', array('choiceid' => $choice->id))) {
            $result = false;
        }

        rebuild_course_cache($course_id);

        $result = array();
        $result['sucess'] = true;
        return $result;
    }

    public static function delete_choice_returns()
    {

        return new external_single_structure(
            array(
                'sucess' => new external_value(PARAM_BOOL, 'Whether the user can do the or not.'),
            )
        );
        return new external_value(PARAM_TEXT, 'The welcome message + user first name');
    }
}
