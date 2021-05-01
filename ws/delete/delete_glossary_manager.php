<?php


require_once($CFG->libdir . "/externallib.php");
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . "/mod/glossary/lib.php");

require_once($CFG->dirroot . '/calendar/lib.php');


class delete_glossary_manager extends external_api
{

    /**
     * Returns description of method result value
     * @return external_function_parameters
     */
    public static function delete_glossary_parameters()
    {
        return new external_function_parameters(
            array(
                'glossary_id' => new external_value(PARAM_INT, 'glossary id', VALUE_DEFAULT, 'Hello world, '),
            )
        );
    }

    public static function delete_glossary($glossary_id)
    {

        global $DB;


        if (!$glossary = $DB->get_record('glossary', array('id' => $glossary_id))) {
            return false;
        }

        $result = true;
        $course_id = $glossary->course;

        // Delete any dependent records here

        if (!$DB->delete_records('glossary', array('id' => $glossary->id))) {
            $result = false;
        }
        if (!$DB->delete_records('glossary_categories', array('glossaryid' => $glossary->id))) {
            $result = false;
        }
        if (!$DB->delete_records('glossary_entries', array('glossaryid' => $glossary->id))) {
            $result = false;
        }

        rebuild_course_cache($course_id);

        $result = array();
        $result['sucess'] = true;
        return $result;
    }

    public static function delete_glossary_returns()
    {

        return new external_single_structure(
            array(
                'sucess' => new external_value(PARAM_BOOL, 'Whether the user can do the or not.'),
            )
        );
        return new external_value(PARAM_TEXT, 'The welcome message + user first name');
    }
}
