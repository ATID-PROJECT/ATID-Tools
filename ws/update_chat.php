<?php


require_once($CFG->libdir . "/externallib.php");


require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot . "/mod/chat/lib.php");


class update_chat extends external_api {


    public static function handle_chat_parameters() {
        return new external_function_parameters(
            array('name' => new external_value(PARAM_TEXT, 'chat name,', VALUE_DEFAULT, 'Hello world, '),
                  'description' => new external_value(PARAM_TEXT, 'chat description,', VALUE_DEFAULT, 'Hello world, '),
                  'chat_id' => new external_value(PARAM_INT, 'chat id ,', VALUE_DEFAULT, 'Hello world, '),
            )
        );
    }


    public static function handle_chat($name = '',$description='',$chat_id=1) {

        global $COURSE, $DB;

        $params = self::validate_parameters(self::handle_chat_parameters(),
                array('name' => $name, 'description' => $description, 'chat_id' => $chat_id ));

        $instance = $DB->get_record('chat', array('id'=>$chat_id), '*', MUST_EXIST);

        $chat->id = $instance->id;
        $chat->name = $name;
        $chat->intro = $description;

        $DB->update_record('chat', $chat);

        $cm = get_coursemodule_from_instance('chat', $chat->id, $instance->course);

        context_module::instance($cm->id);
        rebuild_course_cache($course->id);
        /*add_to_log($course_id, "course", "add mod",
        "../../mod/$cm->modulename/view.php?id=$cm->id",
        "$cm->modulename $cm->instance");
        add_to_log($course_id, 'chat', "add",
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
    public static function handle_chat_returns() {

        return new external_single_structure(
            array(
                'sucess' => new external_value(PARAM_BOOL, 'result query.'),
                
            )
        );

        return new external_value(PARAM_TEXT, 'The welcome message + user first name');
    }

}
