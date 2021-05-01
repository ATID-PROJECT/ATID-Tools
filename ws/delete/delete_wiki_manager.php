<?php


require_once($CFG->libdir . "/externallib.php");
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . "/mod/wiki/lib.php");

require_once($CFG->dirroot . '/calendar/lib.php');


class delete_wiki_manager extends external_api
{

    /**
     * Returns description of method result value
     * @return external_function_parameters
     */
    public static function delete_wiki_parameters()
    {
        return new external_function_parameters(
            array(
                'wiki_id' => new external_value(PARAM_INT, 'wiki id', VALUE_DEFAULT, 'Hello world, '),
            )
        );
    }

    public static function delete_wiki($wiki_id)
    {

        global $DB;


        if (!$wiki = $DB->get_record('wiki', array('id' => $wiki_id))) {
            return false;
        }

        $result = true;
        $course_id = $wiki->course;

        // Delete any dependent records here

        if (!$DB->delete_records('wiki', array('id' => $wiki->id))) {
            $result = false;
        }
        if (!$DB->delete_records('wiki_subwikis', array('wikiid' => $wiki->id))) {
            $result = false;
        }

        rebuild_course_cache($course_id);

        $result = array();
        $result['sucess'] = true;
        return $result;
    }

    public static function delete_wiki_returns()
    {

        return new external_single_structure(
            array(
                'sucess' => new external_value(PARAM_BOOL, 'Whether the user can do the or not.'),
            )
        );
        return new external_value(PARAM_TEXT, 'The welcome message + user first name');
    }
}
