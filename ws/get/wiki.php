<?php


require_once($CFG->libdir . "/externallib.php");

require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot . "/mod/wiki/lib.php");


class get_wiki extends external_api {

    public static function handle_wiki_parameters() {
        return new external_function_parameters(
            array(
                  'wiki_id' => new external_value(PARAM_INT, 'wiki description,', VALUE_DEFAULT, 'Hello world, '),
                  'course_id' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
            )
        );
    }

    public static function handle_wiki($wiki_id='',$course_id=1) {

        global $COURSE, $DB;

        $params = self::validate_parameters(self::handle_wiki_parameters(),
                array('wiki_id' => $wiki_id, 'course_id' => $course_id ));

        $instance = $DB->get_record('wiki', array('id'=>$wiki_id), '*', MUST_EXIST);

        $result = array();
        $result['id'] = $instance->id;
        $result['name'] = strip_tags($instance->name);
        $result['description'] = strip_tags($instance->intro);

        $result['wikimode'] = $instance->wikimode;
        $result['firstpagetitle'] = $instance->firstpagetitle;
        $result['defaultformat'] = $instance->defaultformat;
     
        return $result;
    
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function handle_wiki_returns() {

        return new external_single_structure(
            array(
                'id' => new external_value(PARAM_INT, 'Whether the user can do the quiz or not.'),
                'name' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),
                'description' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),

                'wikimode' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),
                'firstpagetitle' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),
                'defaultformat' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),
                
            )
        );

        return new external_value(PARAM_TEXT, 'The welcome message + user first name');
    }

}
