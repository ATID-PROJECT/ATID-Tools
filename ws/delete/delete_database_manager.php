<?php


require_once($CFG->libdir . "/externallib.php");
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . "/mod/data/lib.php");

require_once($CFG->dirroot . '/calendar/lib.php');


class delete_database_manager extends external_api
{

    /**
     * Returns description of method result value
     * @return external_function_parameters
     */
    public static function delete_database_parameters()
    {
        return new external_function_parameters(
            array(
                'database_id' => new external_value(PARAM_INT, 'data id', VALUE_DEFAULT, 'Hello world, '),
            )
        );
    }

    public static function delete_database($database_id)
    {

        global $DB;


        if (!$data = $DB->get_record('data', array('id' => $database_id))) {
            return false;
        }

        $result = true;
        $course_id = $data->course;

        // Delete any dependent records here

        if (!$DB->delete_records('data', array('id' => $data->id))) {
            $result = false;
        }
        if (!$DB->delete_records('data_fields', array('dataid' => $data->id))) {
            $result = false;
        }
        if (!$DB->delete_records('data_records', array('dataid' => $data->id))) {
            $result = false;
        }

        rebuild_course_cache($course_id);

        $result = array();
        $result['sucess'] = true;
        return $result;
    }

    public static function delete_database_returns()
    {

        return new external_single_structure(
            array(
                'sucess' => new external_value(PARAM_BOOL, 'Whether the user can do the or not.'),
            )
        );
        return new external_value(PARAM_TEXT, 'The welcome message + user first name');
    }
}
