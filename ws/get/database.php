<?php


require_once($CFG->libdir . "/externallib.php");

require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot . "/mod/data/lib.php");


class get_data extends external_api {

    public static function getStringDate( $timestamp ){

        $date = date("Y-m-d H:i:s", $timestamp);
        return $date;
    }

    public static function handle_data_parameters() {
        return new external_function_parameters(
            array(
                  'database_id' => new external_value(PARAM_INT, 'data description,', VALUE_DEFAULT, 'Hello world, '),
                  'course_id' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
            )
        );
    }

    public static function handle_data($database_id='',$course_id=1) {

        global $COURSE, $DB;

        $params = self::validate_parameters(self::handle_data_parameters(),
                array('database_id' => $database_id, 'course_id' => $course_id ));

        $instance = $DB->get_record('data', array('id'=>$database_id), '*', MUST_EXIST);
        $module = $DB->get_record('course_modules', array('instance' => $instance->id, 'course' => $course_id), '*', MUST_EXIST);

        $result = array();
        $result['id'] = $instance->id;
        $result['name'] = strip_tags($instance->name);
        $result['description'] = strip_tags($instance->intro);
        
        $result['approval'] = $instance->approval;
        $result['manageapproved'] = $instance->manageapproved;
        $result['comments'] = $instance->comments;
        $result['requiredentries'] = $instance->requiredentries;
        $result['maxentries'] = $instance->maxentries;

        $result['timeavailablefrom'] = self::getStringDate( $instance->timeavailablefrom );
        $result['timeavailableto'] = self::getStringDate( $instance->timeavailableto );
        $result['timeviewfrom'] = self::getStringDate( $instance->timeviewfrom );
        $result['timeviewto'] = self::getStringDate( $instance->timeviewto );

        $result['cmid'] = $module->id;
     
        return $result;
    
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function handle_data_returns() {

        return new external_single_structure(
            array(
                'id' => new external_value(PARAM_INT, 'Whether the user can do the quiz or not.'),
                'name' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),
                'description' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),

                'approval' => new external_value(PARAM_INT, 'Whether the user can do the quiz or not.'),
                'manageapproved' => new external_value(PARAM_INT, 'Whether the user can do the quiz or not.'),
                'comments' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),
                'requiredentries' => new external_value(PARAM_INT, 'Whether the user can do the quiz or not.'),
                'maxentries' => new external_value(PARAM_INT, 'Whether the user can do the quiz or not.'),

                'timeavailablefrom' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),
                'timeavailableto' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),
                'timeviewfrom' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),
                'timeviewto' => new external_value(PARAM_TEXT, 'Whether the user can do the quiz or not.'),

                'cmid' => new external_value(PARAM_INT, 'Module id.'),
            )
        );

    }

}
