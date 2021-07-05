<?php


require_once($CFG->libdir . "/externallib.php");


require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot . "/mod/chat/lib.php");


class atid_tools_external extends external_api {


    public static function handle_chat_parameters() {
        return new external_function_parameters(
            array('name' => new external_value(PARAM_TEXT, 'chat name,', VALUE_DEFAULT, 'Hello world, '),
                  'description' => new external_value(PARAM_TEXT, 'chat description,', VALUE_DEFAULT, 'Hello world, '),
                  'course_id' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
                  'group_id' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
            )
        );
    }


    public static function handle_chat($name = '',$description='',$course_id=1, $group_id=1) {

        global $COURSE, $DB;

        $params = self::validate_parameters(self::handle_chat_parameters(),
                array('name' => $name, 'description' => $description, 'course_id' => $course_id,
                'group_id' => $group_id
             ));

        $course_id = $course_id;
        $section= 6;
        $course_name= $params["name"];

        // mod generator
        $modulename = 'chat';
        $cm = new stdClass();
        $cm->course             = $course_id;

        $cm->module             = $DB->get_field('modules', 'id', array('name'=>$modulename));
        $cm->instance           = 0;
        $cm->section            = $section;
        $cm->idnumber           = null;
        $cm->added              = time();
        $cm->id					= $DB->insert_record('course_modules', $cm);
    
        course_add_cm_to_section( $course_id, $cm->id, $section);
    

        $chat = new stdClass();
        $chat->modulename = 'chat';
        $chat->course = $course_id;

        $chat->module = $cm->module;
        $chat->name = $course_name;
        $chat->intro = $description;

        $chat->coursemodule = $cm->id;

        $instance = chat_add_instance( $chat );        

        $DB->set_field('course_modules', 'instance', $instance, array('id'=> $chat->coursemodule ));

        

        $instance = $DB->get_record('chat', array('id'=>$instance), '*', MUST_EXIST);
        $cm = get_coursemodule_from_id('chat',  $chat->coursemodule, $instance->course, true, MUST_EXIST);
        context_module::instance($cm->id);
        rebuild_course_cache($course->id, true);
        /*add_to_log($course_id, "course", "add mod",
        "../../mod/$cm->modulename/view.php?id=$cm->id",
        "$cm->modulename $cm->instance");
        add_to_log($course_id, 'chat', "add",
        "view.php?id=$cm->coursemodule",
        "$cm->instance", $cm->id);*/

        $restriction = \core_availability\tree::get_root_json(
            [\availability_group\condition::get_json($group_id)]);
        $DB->set_field('course_modules', 'availability',
        json_encode($restriction), ['id' => $cm->id]);
        rebuild_course_cache($course_id, true);

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
    public static function handle_chat_returns() {

        return new external_single_structure(
            array(
                'id' => new external_value(PARAM_INT, 'Whether the user can do the quiz or not.'),
                'cmid' => new external_value(PARAM_INT, 'Module id.'),
            )
        );
    }

}
