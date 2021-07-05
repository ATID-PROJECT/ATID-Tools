<?php


require_once($CFG->libdir . "/externallib.php");

require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot . "/mod/choice/lib.php");


class get_choice extends external_api {

    public static function handle_choice_parameters() {
        return new external_function_parameters(
            array(
                  'choice_id' => new external_value(PARAM_INT, 'choice description,', VALUE_DEFAULT, 'Hello world, '),
                  'course_id' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
            )
        );
    }

    public static function handle_choice($choice_id='',$course_id=1) {

        global $COURSE, $DB;

        $params = self::validate_parameters(self::handle_choice_parameters(),
                array('choice_id' => $choice_id, 'course_id' => $course_id ));

        $instance = $DB->get_record('choice', array('id'=>$choice_id), '*', MUST_EXIST);
        $module = $DB->get_record('course_modules', array('instance' => $instance->id, 'course' => $course_id), '*', MUST_EXIST);

        $choice->id = $instance->id;
        $choice->name = $name;
        $choice->intro = $description;

        $cm->allowupdate        = $allowupdate;
        $cm->allowmultiple      = $allowmultiple;
        $cm->limitanswers       = $limitanswers;

        $warnings = array();
    
        $result = array();
        $result['id'] = $instance->id;
        $result['name'] = strip_tags($instance->name);
        $result['description'] = strip_tags($instance->intro);
        $result['allowupdate'] = $instance->allowupdate;
        $result['allowmultiple'] = $instance->allowmultiple;
        $result['limitanswers'] = $instance->limitanswers;
        $result['cmid'] = $module->id;
    
        return $result;
    
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function handle_choice_returns() {

        return new external_single_structure(
            array(
                'id' => new external_value(PARAM_INT, 'Whether the user can do the quiz or not.'),
                'name' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),
                'description' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),
                'allowupdate' => new external_value(PARAM_BOOL, 'Whether the user can do the quiz or not.'),
                'allowmultiple' => new external_value(PARAM_BOOL, 'Whether the user can do the quiz or not.'),
                'limitanswers' => new external_value(PARAM_INT, 'Whether the user can do the quiz or not.'),
                'cmid' => new external_value(PARAM_INT, 'Module id.'),
            )
        );
    }

}
