<?php


require_once($CFG->libdir . "/externallib.php");

require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . "/mod/chat/lib.php");


class count_log_events_external extends external_api
{

    public static function count_log_events_parameters()
    {
        return new external_function_parameters(
            array(
                'eventname' => new external_value(PARAM_RAW, 'chat id', VALUE_DEFAULT, ''),
                'course_id' => new external_value(PARAM_INT, 'user id', VALUE_DEFAULT, '0'),
                'context_id' => new external_value(PARAM_INT, 'context id', VALUE_DEFAULT, '0'),
            )
        );
    }

    public static function count_log_events($eventname = '', $course_id = 1, $context_id)
    {
        global $COURSE, $DB;

        self::validate_parameters(
            self::count_log_events_parameters(),
            array('eventname' => $eventname, 'course_id' => $course_id, 'context_id' => $context_id)
        );

        $sql = "
        select userid, count(userid) as total, min(timecreated) as min_time, max(timecreated) as max_time
        from mdl_logstore_standard_log
        where eventname like '".strip_tags($eventname)."'
        and courseid = ".strip_tags($course_id)." and contextinstanceid = ".strip_tags($context_id)."
        group by userid;
        ";

        $query_result = $DB->get_recordset_sql($sql);
        $result = array();

        $i = 0;
        foreach($query_result as $r) {

            $temp = array(
                'userid' => $r->userid,
                'total' => $r->total,
                'min_time' => $r->min_time,
                'max_time' => $r->max_time,
            );
            array_push( $result, $temp );
        }
        
        return $result;
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function count_log_events_returns()
    {

        return new external_multiple_structure(
            new external_single_structure(
            array(
                'userid' => new external_value(PARAM_INT, 'User id.'),
                'total' => new external_value(PARAM_INT, 'Total time.'),
                'min_time' => new external_value(PARAM_RAW, 'Min time.'),
                'max_time' => new external_value(PARAM_RAW, 'Max time.'),
            )
            )
        );

    }
}
