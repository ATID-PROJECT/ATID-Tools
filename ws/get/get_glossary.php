<?php


require_once($CFG->libdir . "/externallib.php");

require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot . "/mod/glossary/lib.php");


class get_glossary extends external_api {

    public static function handle_glossary_parameters() {
        return new external_function_parameters(
            array(
                  'glossary_id' => new external_value(PARAM_INT, 'glossary description,', VALUE_DEFAULT, 'Hello world, '),
                  'course_id' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
            )
        );
    }

    public static function handle_glossary($glossary_id='',$course_id=1) {

        global $COURSE, $DB;

        $params = self::validate_parameters(self::handle_glossary_parameters(),
                array('glossary_id' => $glossary_id, 'course_id' => $course_id ));

        $instance = $DB->get_record('glossary', array('id'=>$glossary_id), '*', MUST_EXIST);
        $module = $DB->get_record('course_modules', array('instance' => $instance->id, 'course' => $course_id), '*', MUST_EXIST);

        $result = array();
        $result['id'] = $instance->id;
        $result['name'] = strip_tags($instance->name);
        $result['description'] = strip_tags($instance->intro);

        $result['mainglossary'] = $instance->mainglossary;
        $result['defaultapproval'] = $instance->defaultapproval;
        $result['editalways'] = $instance->editalways;
        $result['allowduplicatedentries'] = $instance->allowduplicatedentries;
        $result['allowcomments'] = $instance->allowcomments;
        $result['usedynalink'] = $instance->usedynalink;
        $result['displayformat'] = $instance->displayformat;
        $result['approvaldisplayformat'] = $instance->approvaldisplayformat;
        $result['entbypage'] = $instance->entbypage;
        $result['showalphabet'] = $instance->showalphabet;
        $result['showall'] = $instance->showall;
        $result['showspecial'] = $instance->showspecial;
        $result['allowprintview'] = $instance->allowprintview;

        $result['cmid'] = $module->id;
     
        return $result;
    
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function handle_glossary_returns() {

        return new external_single_structure(
            array(
                'id' => new external_value(PARAM_INT, 'Whether the user can do the quiz or not.'),
                'name' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),
                'description' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),

                'mainglossary' => new external_value(PARAM_INT, 'Whether the user can do the quiz or not.'),
                'defaultapproval' => new external_value(PARAM_INT, 'Whether the user can do the quiz or not.'),
                'editalways' => new external_value(PARAM_INT, 'Whether the user can do the quiz or not.'),
                'allowduplicatedentries' => new external_value(PARAM_BOOL, 'Whether the user can do the quiz or not.'),
                'allowcomments' => new external_value(PARAM_BOOL, 'Whether the user can do the quiz or not.'),
                'usedynalink' => new external_value(PARAM_BOOL, 'Whether the user can do the quiz or not.'),
                'displayformat' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),
                'approvaldisplayformat' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),
                'entbypage' => new external_value(PARAM_INT, 'Whether the user can do the quiz or not.'),
                'showalphabet' => new external_value(PARAM_BOOL, 'Whether the user can do the quiz or not.'),
                'showall' => new external_value(PARAM_BOOL, 'Whether the user can do the quiz or not.'),
                'showspecial' => new external_value(PARAM_BOOL, 'Whether the user can do the quiz or not.'),
                'allowprintview' => new external_value(PARAM_BOOL, 'Whether the user can do the quiz or not.'),
                
                'cmid' => new external_value(PARAM_INT, 'Module id.'),
            )
        );
    }

}
