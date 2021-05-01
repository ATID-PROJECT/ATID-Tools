<?php


require_once($CFG->libdir . "/externallib.php");

require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot . "/mod/forum/lib.php");

class get_forum extends external_api {

    public static function handle_forum_parameters() {
        return new external_function_parameters(
            array(
                  'forum_id' => new external_value(PARAM_INT, 'forum description,', VALUE_DEFAULT, 'Hello world, '),
                  'course_id' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
            )
        );
    }

    public static function handle_forum($forum_id='',$course_id=1) {

        global $COURSE, $DB;

        $params = self::validate_parameters(self::handle_forum_parameters(),
                array('forum_id' => $forum_id, 'course_id' => $course_id ));

        $instance = $DB->get_record('forum', array('id'=>$forum_id), '*', MUST_EXIST);

        $result = array();
        $result['id'] = $instance->id;
        $result['name'] = strip_tags($instance->name);
        $result['description'] = strip_tags($instance->intro);

        $result['type'] = $instance->type;
        $result['maxbytes'] = $instance->maxbytes;
        $result['maxattachments'] = $instance->maxattachments;
        $result['displaywordcount'] = $instance->displaywordcount;
        $result['forcesubscribe'] = $instance->forcesubscribe;
        $result['trackingtype'] = $instance->trackingtype;
     
        return $result;
    
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function handle_forum_returns() {

        return new external_single_structure(
            array(
                'id' => new external_value(PARAM_INT, 'Whether the user can do the quiz or not.'),
                'name' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),
                'description' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),

                'type' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),
                'maxbytes' => new external_value(PARAM_INT, 'Whether the user can do the quiz or not.'),
                'maxattachments' => new external_value(PARAM_INT, 'Whether the user can do the quiz or not.'),
                'displaywordcount' => new external_value(PARAM_BOOL, 'Whether the user can do the quiz or not.'),
                'forcesubscribe' => new external_value(PARAM_BOOL, 'Whether the user can do the quiz or not.'),
                'trackingtype' => new external_value(PARAM_BOOL, 'Whether the user can do the quiz or not.'),
                
            )
        );

        return new external_value(PARAM_TEXT, 'The welcome message + user first name');
    }

}
