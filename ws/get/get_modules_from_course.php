<?php


require_once($CFG->libdir . "/externallib.php");

require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . "/mod/chat/lib.php");


class get_modules_from_course extends external_api
{

    public static function handle_course_module_parameters()
    {
        return new external_function_parameters(
            array(
                'course' => new external_value(PARAM_INT, 'course description,', VALUE_DEFAULT, 'Hello world, '),
            )
        );
    }

    public static function handle_course_module($course = 1)
    {

        global $COURSE, $DB;

        $sql = "SELECT * FROM mdl_course_sections WHERE course=".$course."";

        $query_result = $DB->get_recordset_sql($sql);

        $result = array();

        foreach($query_result as $r) {
            $temp = array(
                'id' => $r->id,
                'course' => $r->course,
                'section' => $r->section,
                'name' => $r->name,
                'sequence' => $r->sequence,
                'timemodified' => $r->timemodified,
            );
            array_push( $result, $temp );
        }

        return $result;
    }

    public static function handle_course_module_returns()
    {
        return new external_multiple_structure(
        new external_single_structure(
            array(
                'id' => new external_value(PARAM_INT, ''),
                'course' => new external_value(PARAM_INT, ''),
                'section' => new external_value(PARAM_INT, ''),
                'name' => new external_value(PARAM_RAW, ''),
                'sequence' => new external_value(PARAM_RAW, ''),
                'timemodified' => new external_value(PARAM_INT, ''),
        )
        )
        );
    }
}
