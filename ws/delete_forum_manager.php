<?php

// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * External Web Service Template
 *
 * @package    localwstemplate
 * @copyright  2011 Moodle Pty Ltd (http://moodle.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once($CFG->libdir . "/externallib.php");
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . "/mod/forum/lib.php");

require_once($CFG->dirroot . '/calendar/lib.php');


class delete_forum_manager extends external_api
{

    /**
     * Returns description of method result value
     * @return external_function_parameters
     */
    public static function delete_forum_parameters()
    {
        return new external_function_parameters(
            array(
                'forum_id' => new external_value(PARAM_INT, 'forum id', VALUE_DEFAULT, 'Hello world, '),
            )
        );
    }

    public static function delete_forum($forum_id)
    {
        global $DB;

        if (!$forum = $DB->get_record('forum', array('id' => $forum_id))) {
            return false;
        }
        if (!$cm = get_coursemodule_from_instance('forum', $forum->id)) {
            return false;
        }
        if (!$course = $DB->get_record('course', array('id' => $cm->course))) {
            return false;
        }

        $context = get_context_instance(CONTEXT_MODULE, $cm->id);

        // now get rid of all files
        $fs = get_file_storage();
        $fs->delete_area_files($context->id);

        $result = true;
        $course_id = $forum->course;

        if ($discussions = $DB->get_records('forum_discussions', array('forum' => $forum->id))) {
            foreach ($discussions as $discussion) {
                if (!forum_delete_discussion($discussion, true, $course, $cm, $forum)) {
                    $result = false;
                }
            }
        }

        if (!$DB->delete_records('forum_subscriptions', array('forum' => $forum->id))) {
            $result = false;
        }

        forum_tp_delete_read_records(-1, -1, -1, $forum->id);

        if (!$DB->delete_records('forum', array('id' => $forum->id))) {
            $result = false;
        }

        forum_grade_item_delete($forum);

        rebuild_course_cache($course_id);

        $result = array();
        $result['sucess'] = true;
        return $result;
    }

    public static function delete_forum_returns()
    {

        return new external_single_structure(
            array(
                'sucess' => new external_value(PARAM_BOOL, 'Whether the user can do the or not.'),
            )
        );
        return new external_value(PARAM_TEXT, 'The welcome message + user first name');
    }
}
