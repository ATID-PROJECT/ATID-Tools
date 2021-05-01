<?php


require_once($CFG->libdir . "/externallib.php");
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . "/mod/lti/lib.php");

require_once($CFG->dirroot . '/calendar/lib.php');


class delete_lti_manager extends external_api
{

    /**
     * Returns description of method result value
     * @return external_function_parameters
     */
    public static function delete_lti_parameters()
    {
        return new external_function_parameters(
            array(
                'lti_id' => new external_value(PARAM_INT, 'lti id', VALUE_DEFAULT, 'Hello world, '),
            )
        );
    }

    public static function delete_lti($lti_id)
    {

        global $DB;


        if (!$lti = $DB->get_record('lti', array('id' => $lti_id))) {
            return false;
        }

        $result = true;
        $course_id = $lti->course;

        // Delete any dependent records here

        if (!$DB->delete_records('lti', array('id' => $lti->id))) {
            $result = false;
        }
        if (!$DB->delete_records('lti_submission', array('ltiid' => $lti->id))) {
            $result = false;
        }
        if (!$DB->delete_records('lti_types_config', array('ltiid' => $lti->id))) {
            $result = false;
        }
        if (!$DB->delete_records('ltiservice_gradebookservices', array('ltilinkid' => $lti->id))) {
            $result = false;
        }

        rebuild_course_cache($course_id);

        $result = array();
        $result['sucess'] = true;
        return $result;
    }

    public static function delete_lti_returns()
    {

        return new external_single_structure(
            array(
                'sucess' => new external_value(PARAM_BOOL, 'Whether the user can do the or not.'),
            )
        );
        return new external_value(PARAM_TEXT, 'The welcome message + user first name');
    }
}
