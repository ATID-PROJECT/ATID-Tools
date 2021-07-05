<?php


require_once($CFG->libdir . "/externallib.php");


require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot . "/mod/lesson/lib.php");

class update_module_availability_external extends external_api {

    public static function handle_update_module_availability_parameters() {
        return new external_function_parameters(
            array(
                  'id' => new external_value(PARAM_TEXT, 'id,', VALUE_DEFAULT, 'instance'),
                  'availability' => new external_value(PARAM_TEXT, 'course id,', VALUE_DEFAULT, 'course'),
                )
        );
    }

    public static function handle_update_module_availability($id=1, $availability=1) {

        global $COURSE, $DB;
        
        $instance = $DB->get_record('course_modules', array('id'=> $id), '*', MUST_EXIST);
        $instance->availability = $availability;
        $DB->update_record('course_modules', $instance);

        $result = array();
        $result['sucess'] = true;
        return $result;
    }

    public static function handle_update_module_availability_returns() {

        return new external_single_structure(
            array(
                'sucess' => new external_value(PARAM_BOOL, 'Whether the user can do the quiz or not.'),
            )
        );

    }
}
