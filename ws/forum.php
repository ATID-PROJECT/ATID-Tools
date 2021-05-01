<?php

require_once($CFG->libdir . "/externallib.php");

require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . "/mod/forum/lib.php");
require_once($CFG->libdir . '/filelib.php');
require_once($CFG->libdir . '/completionlib.php');
require_once($CFG->dirroot . '/user/selector/lib.php');


class forum_wstemplate_external extends external_api
{

    public static function handle_forum_parameters()
    {
        return new external_function_parameters(
            array(
                'name' => new external_value(PARAM_TEXT, 'chat name,', VALUE_DEFAULT, 'Hello world, '),
                'description' => new external_value(PARAM_TEXT, 'chat description,', VALUE_DEFAULT, 'Hello world, '),
                'course_id' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
                'group_id' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
            )
        );
    }

    public static function handle_forum(
        $name = '',
        $description = '',
        $course_id = 1,
        $group_id = 1
    ) {

        global $DB;

        // mod generator
        $modulename = 'forum';
        $section = 6;
        $cm = new stdClass();
        $cm->course             = $course_id;

        $cm->module             = $DB->get_field('modules', 'id', array('name' => $modulename));
        $cm->instance           = 0;
        $cm->section            = $section;
        $cm->idnumber           = null;
        $cm->added              = time();
        $cm->id                 = $DB->insert_record('course_modules', $cm);

        course_add_cm_to_section($course_id, $cm->id, $section);

        $forum = new stdClass();
        $forum->coursemodule = $cm->id;
        $forum->course = $course_id;
        $forum->name = $name;
        $forum->intro = $description;
        $forum->introformat = FORMAT_MOODLE;
        $forum->forcesubscribe = FORUM_FORCESUBSCRIBE;
        $forum->type = 'single';

        $forum->timemodified = time();

        if (empty($forum->assessed)) {
            $forum->assessed = 0;
        }

        if (empty($forum->ratingtime) or empty($forum->assessed)) {
            $forum->assesstimestart  = 0;
            $forum->assesstimefinish = 0;
        }

        $forum->id = $DB->insert_record('forum', $forum);
        $modcontext = get_context_instance(CONTEXT_MODULE, $forum->coursemodule);

        if ($forum->type == 'single') {  // Create related discussion.
            $discussion = new stdClass();
            $discussion->course        = $forum->course;
            $discussion->forum         = $forum->id;
            $discussion->name          = $forum->name;
            $discussion->assessed      = $forum->assessed;
            $discussion->message       = $forum->intro;
            $discussion->messageformat = $forum->introformat;
            $discussion->messagetrust  = trusttext_trusted(get_context_instance(CONTEXT_COURSE, $forum->course));
            $discussion->mailnow       = false;
            $discussion->groupid       = -1;

            $message = '';

            $discussion->id = forum_add_discussion($discussion, null, $message);
        }

        if ($forum->forcesubscribe == FORUM_INITIALSUBSCRIBE) {
            /// all users should be subscribed initially
            /// Note: forum_get_potential_subscribers should take the forum context,
            /// but that does not exist yet, becuase the forum is only half build at this
            /// stage. However, because the forum is brand new, we know that there are
            /// no role assignments or overrides in the forum context, so using the
            /// course context gives the same list of users.
            $users = forum_get_potential_subscribers($modcontext, 0, 'u.id, u.email', '');
            foreach ($users as $user) {
                forum_subscribe($user->id, $forum->id);
            }
        }

        $instance = forum_add_instance($forum);

        $DB->set_field('course_modules', 'instance', $instance, array('id' => $forum->coursemodule));

        $instance = $DB->get_record('forum', array('id' => $instance), '*', MUST_EXIST);
        $cm = get_coursemodule_from_id('forum',  $forum->coursemodule, $instance->course, true, MUST_EXIST);
        context_module::instance($cm->id);
        rebuild_course_cache($course_id);

        $restriction = \core_availability\tree::get_root_json(
            [\availability_group\condition::get_json($group_id)]
        );
        $DB->set_field(
            'course_modules',
            'availability',
            json_encode($restriction),
            ['id' => $cm->id]
        );
        rebuild_course_cache($course_id, true);

        $result = array();
        $result['id'] = $instance->id;
        return $result;
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function handle_forum_returns()
    {

        return new external_single_structure(
            array(
                'id' => new external_value(PARAM_INT, 'Whether the user can do the quiz or not.'),
            )
        );

        return new external_value(PARAM_TEXT, 'The welcome message + user first name');
    }
}
