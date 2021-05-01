
<?php


require_once($CFG->libdir . "/externallib.php");


require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot . "/mod/lti/lib.php");

class update_extern_tool extends external_api {


    public static function handle_lti_parameters() {
        return new external_function_parameters(
            array('name' => new external_value(PARAM_TEXT, 'lti name,', VALUE_DEFAULT, 'Hello world, '),
                  'description' => new external_value(PARAM_TEXT, 'lti description,', VALUE_DEFAULT, 'Hello world, '),
                  'lti_id' => new external_value(PARAM_INT, 'lti id ,', VALUE_DEFAULT, 'Hello world, '),
                  )
        );
    }

    public function get_string_value( $value ) {
        if( is_null( $value) )
            return "";
        else{
            return $value;
        }
    }

    public static function handle_lti($name = '',$description='',$lti_id=1
        ) {

        global $COURSE, $DB;

       

        $lti = new stdClass();
        $lti->modulename = 'lti';
        $lti->id = $lti_id;

        $lti->name = $name;
        $lti->intro = $description;

        $DB->update_record('lti', $lti);
        
        $instance = $DB->get_record('lti', array('id'=> $lti->id), '*', MUST_EXIST);
        $cm = get_coursemodule_from_instance('lti', $lti->id, $instance->course);

        context_module::instance($cm->id);
        rebuild_course_cache($course->id);
        /*add_to_log($course_id, "course", "add mod",
        "../../mod/$cm->modulename/view.php?id=$cm->id",
        "$cm->modulename $cm->instance");
        add_to_log($course_id, 'lti', "add",
        "view.php?id=$cm->coursemodule",
        "$cm->instance", $cm->id);*/

        $warnings = array();

        $result = array();
        $result['sucess'] = true;
        return $result;
    
    }


    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function handle_lti_returns() {

        return new external_single_structure(
            array(
                'sucess' => new external_value(PARAM_BOOL, 'Whether the user can do the quiz or not.'),
                
            )
        );

        return new external_value(PARAM_TEXT, 'The welcome message + user first name');
    }

}
