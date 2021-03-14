<?php


require_once($CFG->libdir . "/externallib.php");

require_once($CFG->dirroot.'/course/lib.php');

class choice_option_wstemplate_external extends external_api {

    public static function handle_choice_options_parameters() {
        return new external_function_parameters(
            array('choiceid' => new external_value(PARAM_TEXT, 'choice_optionsbase name,', VALUE_DEFAULT, 'Hello world, '),
                  'text' => new external_value(PARAM_TEXT, 'choice_optionsbase description,', VALUE_DEFAULT, 'Hello world, '),
                  'maxanswers' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
                )
        );
    }

    public static function handle_choice_options($choiceid="",$text="",$maxanswers=1) {

        global $COURSE, $DB;

        $params = self::validate_parameters(self::handle_choice_options_parameters(),
                array('choiceid' => $choiceid, 'text' => $text, 'maxanswers' => $maxanswers   ));

    
        $choice_options = new stdClass();
        $choice_options->modulename = 'choice_options';
        $choice_options->course = $course_id;

        $choice_options->module = $cm->module;

        $choice_options->choiceid = $choiceid;
        $choice_options->text = $text;
        $choice_options->maxanswers = $maxanswers;
        $choice_options->timemodified = time();

        $choice_options->coursemodule = $cm->id;

        $DB->insert_record("choice_options", $choice_options);

        $warnings = array();

        $result = array();
        $result['hasgrade'] = false;
        return $result;
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function handle_choice_options_returns() {

        return new external_single_structure(
            array(
                'hasgrade' => new external_value(PARAM_BOOL, 'Whether the user can do the quiz or not.'),
            )
        );

        return new external_value(PARAM_TEXT, 'The welcome message + user first name');
    }
}
