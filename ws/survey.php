<?php


require_once($CFG->libdir . "/externallib.php");


require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot . "/mod/survey/lib.php");


class atid_tools_external extends external_api {


    public static function handle_survey_parameters() {
        return new external_function_parameters(
            array('name' => new external_value(PARAM_TEXT, 'survey name,', VALUE_DEFAULT, 'Hello world, '),
                  'description' => new external_value(PARAM_TEXT, 'survey description,', VALUE_DEFAULT, 'Hello world, '),
                  'course_id' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '))
        );
    }


    public static function handle_survey($name = '',$description='',$course_id=1) {

        global $COURSE, $DB;

        $params = self::validate_parameters(self::handle_survey_parameters(),
                array('name' => $name, 'description' => $description, 'course_id' => $course_id ));

        $course_id = $course_id;
        $section= 6;
        $course_name= $params["name"];

        // mod generator
        $modulename = 'survey';
        $cm = new stdClass();
        $cm->course             = $course_id;

        $cm->module             = $DB->get_field('modules', 'id', array('name'=>$modulename));
        $cm->instance           = 0;
        $cm->section            = $section;
        $cm->idnumber           = null;
        $cm->added              = time();
        $cm->id					= $DB->insert_record('course_modules', $cm);
    
        course_add_cm_to_section( $course_id, $cm->id, $section);
    

        $survey = new stdClass();
        $survey->modulename = 'survey';
        $survey->course = $course_id;

        $survey->module = $cm->module;
        $survey->name = $course_name;
        $survey->intro = $description;

        $survey->coursemodule = $cm->id;

        $instance = survey_add_instance( $survey );

        $DB->set_field('course_modules', 'instance', $instance, array('id'=> $survey->coursemodule ));

        $instance = $DB->get_record('survey', array('id'=>$instance), '*', MUST_EXIST);
        $cm = get_coursemodule_from_id('survey',  $survey->coursemodule, $instance->course, true, MUST_EXIST);
        context_module::instance($cm->id);
        rebuild_course_cache($course->id);
        /*add_to_log($course_id, "course", "add mod",
        "../../mod/$cm->modulename/view.php?id=$cm->id",
        "$cm->modulename $cm->instance");
        add_to_log($course_id, 'survey', "add",
        "view.php?id=$cm->coursemodule",
        "$cm->instance", $cm->id);*/

        $warnings = array();

        $result = array();
        $result['id'] = $instance->id;
        $result['cmid'] = $cm->id;
        return $result;
    
    }


    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function handle_survey_returns() {

        return new external_single_structure(
            array(
                'id' => new external_value(PARAM_INT, 'Whether the user can do the quiz or not.'),
                'cmid' => new external_value(PARAM_INT, 'Module id.'),
            )
        );
    }

}
