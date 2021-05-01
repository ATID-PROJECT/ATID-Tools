<?php


require_once($CFG->libdir . "/externallib.php");


require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot . "/mod/lesson/lib.php");

class update_lesson extends external_api {

    public static function handle_lesson_parameters() {
        return new external_function_parameters(
            array('name' => new external_value(PARAM_TEXT, 'lessonbase name,', VALUE_DEFAULT, 'Test name'),
                  'description' => new external_value(PARAM_TEXT, 'lessonbase description,', VALUE_DEFAULT, 'Test description'),
                  'lesson_id' => new external_value(PARAM_INT, 'lesson id ,', VALUE_DEFAULT, -1),

                  /*'type' => new external_value(PARAM_INT, '', VALUE_DEFAULT, 'Hello world, '),
                  'maxbytes' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
                  'maxattachments' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
                  'displaywordcount' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),

                  'forcesubscribe' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
                  'trackingtype' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),*/
                 
                )
        );
    }
    //$type=0, $maxbytes=0, $maxattachments=0,$displaywordcount=0,$forcesubscribe=0,$trackingtype=0
    public static function handle_lesson($name = '',$description='',$lesson_id=1) {

        global $COURSE, $DB;

        /*$params = self::validate_parameters(self::handle_lesson_parameters(),
                array('name' => $name, 'description' => $description, 'lesson_id' => $lesson_id,
                    'type' => $type, 'maxbytes' => $maxbytes, 'maxattachments' => $maxattachments,
                    'displaywordcount' => $displaywordcount, 'forcesubscribe' => $forcesubscribe, 'trackingtype' => $trackingtype
                    ));*/

        $lesson = new stdClass();
        $lesson->modulename = 'lesson';
        $lesson->id = $lesson_id;

        $lesson->name = $name;
        $lesson->intro = $description;

        /*$lesson->type = $type;
        $lesson->maxbytes = $maxbytes;
        $lesson->maxattachments = $maxattachments;
        $lesson->displaywordcount = $displaywordcount;
        $lesson->forcesubscribe = $forcesubscribe;
        $lesson->trackingtype = $trackingtype;*/

        $DB->update_record('lesson', $lesson);
        
        $instance = $DB->get_record('lesson', array('id'=> $lesson->id), '*', MUST_EXIST);
        $cm = get_coursemodule_from_instance('lesson', $lesson->id, $instance->course);
        
        context_module::instance($cm->id);
        rebuild_course_cache($course->id);
        /*add_to_log($course_id, "course", "add mod",
        "../../mod/$cm->modulename/view.php?id=$cm->id",
        "$cm->modulename $cm->instance");
        add_to_log($course_id, 'lesson', "add",
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
    public static function handle_lesson_returns() {

        return new external_single_structure(
            array(
                'sucess' => new external_value(PARAM_BOOL, 'Whether the user can do the quiz or not.'),
            )
        );

        return new external_value(PARAM_TEXT, 'The welcome message + user first name');
    }
}
