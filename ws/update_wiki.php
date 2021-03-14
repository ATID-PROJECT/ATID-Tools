<?php


require_once($CFG->libdir . "/externallib.php");


require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot . "/mod/wiki/lib.php");


class update_wiki extends external_api {

    public static function handle_wiki_parameters() {
        return new external_function_parameters(
            array('name' => new external_value(PARAM_TEXT, 'wiki name,', VALUE_DEFAULT, 'Hello world, '),
                  'description' => new external_value(PARAM_TEXT, 'wiki description,', VALUE_DEFAULT, 'Hello world, '),
                  'wiki_id' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),

                  'wikimode' => new external_value(PARAM_TEXT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
                  'firstpagetitle' => new external_value(PARAM_TEXT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
                  'defaultformat' => new external_value(PARAM_TEXT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
                 
            )
        );
    }


    public static function handle_wiki($name = '',$description='',$wiki_id=1,$wikimode="",$firstpagetitle="",$defaultformat="") {

        global $COURSE, $DB;

        $params = self::validate_parameters(self::handle_wiki_parameters(),
                array('name' => $name, 'description' => $description, 'wiki_id' => $wiki_id,
                'wikimode'=>$wikimode, 'firstpagetitle'=>$firstpagetitle, 'defaultformat'=>$defaultformat
            ));

        $wiki = new stdClass();
        $wiki->modulename = 'wiki';
        $wiki->id = $wiki_id;

        $wiki->name = $name;
        $wiki->intro = $description;
        $wiki->wikimode = $wikimode;
        $wiki->firstpagetitle = $firstpagetitle;
        $wiki->defaultformat = $defaultformat;

        $DB->update_record('wiki', $wiki);
        
        $instance = $DB->get_record('wiki', array('id'=> $wiki->id), '*', MUST_EXIST);
        $cm = get_coursemodule_from_instance('wiki', $wiki->id, $instance->course);

        context_module::instance($cm->id);
        rebuild_course_cache($course->id);
        /*add_to_log($course_id, "course", "add mod",
        "../../mod/$cm->modulename/view.php?id=$cm->id",
        "$cm->modulename $cm->instance");
        add_to_log($course_id, 'wiki', "add",
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
    public static function handle_wiki_returns() {

        return new external_single_structure(
            array(
                'sucess' => new external_value(PARAM_BOOL, 'Whether the user can do the quiz or not.'),
                
            )
        );

        return new external_value(PARAM_TEXT, 'The welcome message + user first name');
    }

}
