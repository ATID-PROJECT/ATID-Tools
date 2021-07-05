<?php


require_once($CFG->libdir . "/externallib.php");

require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . "/mod/chat/lib.php");


class get_course_grade_items_external extends external_api
{

    public static function handle_get_grade_items_parameters()
    {
        return new external_function_parameters(
            array(
                'course' => new external_value(PARAM_INT, 'course id,', VALUE_DEFAULT, 'Hello world, '),
            )
        );
    }

    public static function handle_get_grade_items($course = 1)
    {
        global $DB;

        $sql = "SELECT * FROM mdl_grade_items WHERE courseid=".$course."";

        $query_result = $DB->get_recordset_sql($sql);

        $result = array();

        foreach($query_result as $r) {
            $temp = array(
                'id' => $r->id,
                'course' => $r->courseid,
                'category' => $r->categoryid,
                'itemname' => $r->itemname,
                'itemtype' => $r->itemtype,
                'itemmodule' => $r->itemmodule,
                'iteminstance' => $r->iteminstance,
            );
            array_push( $result, $temp );
        }

        return $result;
    }

    public static function handle_get_grade_items_returns()
    {
        return new external_multiple_structure(
            new external_single_structure(
            array(
                'id' => new external_value(PARAM_INT, ''),
                'course' => new external_value(PARAM_INT, ''),
                'category' => new external_value(PARAM_INT, ''),
                'itemname' => new external_value(PARAM_RAW, ''),
                'itemtype' => new external_value(PARAM_RAW, ''),
                'itemmodule' => new external_value(PARAM_RAW, ''),
                'iteminstance' => new external_value(PARAM_RAW, ''),
            )
        )
        );
    }
}
