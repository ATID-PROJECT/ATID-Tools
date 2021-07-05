<?php


require_once($CFG->libdir . "/externallib.php");

require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . "/mod/chat/lib.php");


class get_course_module_external extends external_api
{

    public static function handle_get_course_module_parameters()
    {
        return new external_function_parameters(
            array(
                'course' => new external_value(PARAM_INT, 'course id,', VALUE_DEFAULT, 'Hello world, '),
                'module' => new external_value(PARAM_INT, 'module id,', VALUE_DEFAULT, 'Hello world, '),
            )
        );
    }

    public static function handle_get_course_module($course = 1, $module = 1)
    {

        global $DB;

        $instance = $DB->get_record('course_modules', array('course'=> $course, 'id' => $module), '*', MUST_EXIST);

        $result = array();

        $result['id'] = $instance->id;
        $result['course'] = $instance->course;
        $result['module'] = $instance->module;
        $result['instance'] = $instance->instance;
        $result['availability'] = $instance->availability;

        return $result;
    }

    public static function handle_get_course_module_returns()
    {
        return new external_single_structure(
            array(
                'id' => new external_value(PARAM_INT, ''),
                'course' => new external_value(PARAM_INT, ''),
                'module' => new external_value(PARAM_INT, ''),
                'instance' => new external_value(PARAM_INT, ''),
                'availability' => new external_value(PARAM_RAW, ''),
            )
        );
    }
}
