<?php


require_once($CFG->libdir . "/externallib.php");


require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot . "/mod/forum/lib.php");

class update_forum extends external_api {

    public static function handle_forum_parameters() {
        return new external_function_parameters(
            array('name' => new external_value(PARAM_TEXT, 'forumbase name,', VALUE_DEFAULT, 'Hello world, '),
                  'description' => new external_value(PARAM_TEXT, 'forumbase description,', VALUE_DEFAULT, 'Hello world, '),
                  'forum_id' => new external_value(PARAM_INT, 'forum id ,', VALUE_DEFAULT, 'Hello world, '),

                  'type' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
                  'maxbytes' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
                  'maxattachments' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
                  'displaywordcount' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),

                  'forcesubscribe' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
                  'trackingtype' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
                 
                )
        );
    }

    public static function handle_forum($name = '',$description='',$forum_id=1,
        $type=0, $maxbytes=0, $maxattachments=0,$displaywordcount=0,$forcesubscribe=0,$trackingtype=0) {

        global $COURSE, $DB;

        $params = self::validate_parameters(self::handle_forum_parameters(),
                array('name' => $name, 'description' => $description, 'forum_id' => $forum_id,
                    'type' => $type, 'maxbytes' => $maxbytes, 'maxattachments' => $maxattachments,
                    'displaywordcount' => $displaywordcount, 'forcesubscribe' => $forcesubscribe, 'trackingtype' => $trackingtype
                    ));

        $forum = new stdClass();
        $forum->modulename = 'forum';
        $forum->id = $forum_id;

        $forum->name = $name;
        $forum->intro = $description;

        $forum->type = $type;
        $forum->maxbytes = $maxbytes;
        $forum->maxattachments = $maxattachments;
        $forum->displaywordcount = $displaywordcount;
        $forum->forcesubscribe = $forcesubscribe;
        $forum->trackingtype = $trackingtype;

        $DB->update_record('forum', $forum);
        
        $instance = $DB->get_record('forum', array('id'=> $forum->id), '*', MUST_EXIST);
        $cm = get_coursemodule_from_instance('forum', $forum->id, $instance->course);
        
        context_module::instance($cm->id);
        rebuild_course_cache($course->id);
        /*add_to_log($course_id, "course", "add mod",
        "../../mod/$cm->modulename/view.php?id=$cm->id",
        "$cm->modulename $cm->instance");
        add_to_log($course_id, 'forum', "add",
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
    public static function handle_forum_returns() {

        return new external_single_structure(
            array(
                'sucess' => new external_value(PARAM_BOOL, 'Whether the user can do the quiz or not.'),
            )
        );

        return new external_value(PARAM_TEXT, 'The welcome message + user first name');
    }
}
