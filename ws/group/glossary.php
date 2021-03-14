<?php


require_once($CFG->libdir . "/externallib.php");

require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot . "/mod/glossary/lib.php");


class group_glossary_manager extends external_api {


    public static function group_glossary_parameters() {
        return new external_function_parameters(
            array(
                  'glossary_id' => new external_value(PARAM_TEXT, 'glossary id,', VALUE_DEFAULT, 'Hello world, '),
                  'course_id' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
                  'group_id' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
            )
        );
    }


    public static function group_glossary($glossary_id=0,$course_id=1, $group_id=1) {

        global $COURSE, $DB;

        $params = self::validate_parameters(self::group_glossary_parameters(),
                array('glossary_id' => $glossary_id, 'course_id' => $course_id,
                'group_id' => $group_id
             ));

        $instance = $DB->get_record('glossary', array('id'=>$glossary_id), '*', MUST_EXIST);

        $cm = get_coursemodule_from_instance('glossary', $glossary_id, $instance->course);
        context_module::instance($cm->id);
        rebuild_course_cache($course_id);

        $restriction = \core_availability\tree::get_root_json(
            [\availability_group\condition::get_json($group_id)]);
        $DB->set_field('course_modules', 'availability',
        json_encode($restriction), ['id' => $cm->id]);
        rebuild_course_cache($course_id, true);

        $result = array();
        $result['hasgrade'] = true;
        return $result;
    
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function group_glossary_returns() {

        return new external_single_structure(
            array(
                'hasgrade' => new external_value(PARAM_BOOL, 'Whether the user can do the quiz or not.'),
            )
        );

        return new external_value(PARAM_TEXT, 'The welcome message + user first name');
    }

}
