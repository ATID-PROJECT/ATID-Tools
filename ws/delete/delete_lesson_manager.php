<?php


require_once($CFG->libdir . "/externallib.php");
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . "/mod/lesson/lib.php");

require_once($CFG->dirroot . '/calendar/lib.php');


class delete_lesson_manager extends external_api
{

    /**
     * Returns description of method result value
     * @return external_function_parameters
     */
    public static function delete_lesson_parameters()
    {
        return new external_function_parameters(
            array(
                'lesson_id' => new external_value(PARAM_INT, 'lesson id', VALUE_DEFAULT, 'Hello world, '),
            )
        );
    }

    public static function delete_lesson($lesson_id)
    {

        global $DB;


        if (!$lesson = $DB->get_record('lesson', array('id' => $lesson_id))) {
            return false;
        }

        $result = true;
        $course_id = $lesson->course;

        // Delete any dependent records here

        if (!$DB->delete_records('lesson', array('id' => $lesson->id))) {
            $result = false;
        }
        if (!$DB->delete_records('lesson_pages', array('lessonid' => $lesson->id))) {
            $result = false;
        }
        if (!$DB->delete_records('lesson_grades', array('lessonid' => $lesson->id))) {
            $result = false;
        }
        if (!$DB->delete_records('lesson_overrides', array('lessonid' => $lesson->id))) {
            $result = false;
        }
        if (!$DB->delete_records('lesson_timer', array('lessonid' => $lesson->id))) {
            $result = false;
        }

        rebuild_course_cache($course_id);

        $result = array();
        $result['sucess'] = true;
        return $result;
    }

    public static function delete_lesson_returns()
    {

        return new external_single_structure(
            array(
                'sucess' => new external_value(PARAM_BOOL, 'Whether the user can do the or not.'),
            )
        );
        return new external_value(PARAM_TEXT, 'The welcome message + user first name');
    }
}
