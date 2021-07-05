<?php


require_once($CFG->libdir . "/externallib.php");

require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot . "/mod/lti/lib.php");


class get_lti extends external_api {

    public static function handle_lti_parameters() {
        return new external_function_parameters(
            array(
                  'lti_id' => new external_value(PARAM_INT, 'lti description,', VALUE_DEFAULT, 'Hello world, '),
                  'course_id' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
            )
        );
    }

    public static function handle_lti($lti_id='',$course_id=1) {

        global $COURSE, $DB;

        $params = self::validate_parameters(self::handle_lti_parameters(),
                array('lti_id' => $lti_id, 'course_id' => $course_id ));

        $instance = $DB->get_record('lti', array('id'=>$lti_id), '*', MUST_EXIST);
        $module = $DB->get_record('course_modules', array('instance' => $instance->id, 'course' => $course_id), '*', MUST_EXIST);

        $result = array();
        $result['id'] = $instance->id;
        $result['name'] = strip_tags($instance->name);
        $result['description'] = strip_tags($instance->intro);

        $result['showdescription'] = $instance->debuglaunch;
        $result['showtitlelaunch'] = $instance->showtitlelaunch;
        $result['showdescriptionlaunch'] = $instance->showdescriptionlaunch;
        $result['typeid'] = $instance->typeid;
        $result['launchcontainer'] = $instance->launchcontainer;

        $result['toolurl'] = $instance->toolurl;
        $result['securetoolurl'] = $instance->securetoolurl;
        $result['resourcekey'] = $instance->resourcekey;
        $result['password'] = $instance->password;
        $result['instructorcustomparameters'] = $instance->instructorcustomparameters;

        $result['cmid'] = $module->id;

        return $result;
    
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function handle_lti_returns() {

        return new external_single_structure(
            array(
                'id' => new external_value(PARAM_INT, 'Whether the user can do the quiz or not.'),
                'name' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),
                'description' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),

                'showdescription' => new external_value(PARAM_BOOL, 'Whether the user can do the quiz or not.'),
                'showtitlelaunch' => new external_value(PARAM_BOOL, 'Whether the user can do the quiz or not.'),
                'showdescriptionlaunch' => new external_value(PARAM_BOOL, 'Whether the user can do the quiz or not.'),
                'typeid' => new external_value(PARAM_INT, 'Whether the user can do the quiz or not.'),
                'launchcontainer' => new external_value(PARAM_INT, 'Whether the user can do the quiz or not.'),

                'toolurl' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),
                'securetoolurl' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),
                'resourcekey' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),
                'password' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),
                'instructorcustomparameters' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),
                
                'cmid' => new external_value(PARAM_INT, 'Module id.'),
            )
        );
    }

}
