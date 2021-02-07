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


require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot . "/mod/choice/lib.php");

class choice_wstemplate_external extends external_api {

    public static function handle_choice_parameters() {
        return new external_function_parameters(
            array('name' => new external_value(PARAM_TEXT, 'choicebase name,', VALUE_DEFAULT, 'Hello world, '),
                  'description' => new external_value(PARAM_TEXT, 'choicebase description,', VALUE_DEFAULT, 'Hello world, '),
                  'course_id' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),

                  'allowupdate' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
                  'allowmultiple' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
                  'limitanswers' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
                  'group_id' => new external_value(PARAM_INT, 'course id ,', VALUE_DEFAULT, 'Hello world, '),
                )
        );
    }

    public static function handle_choice($name = '',$description='',$course_id=1,
        $allowupdate=0, $allowmultiple=0, $limitanswers=0, $group_id=1) {

        global $COURSE, $DB;

        $params = self::validate_parameters(self::handle_choice_parameters(),
                array('name' => $name, 'description' => $description, 'course_id' => $course_id,
                    'allowupdate' => $allowupdate, 'allowmultiple' => $allowmultiple, 'limitanswers' => $limitanswers,
                    'group_id' => $group_id
                    ));

        $section= 6;
        $course_name= $params["name"];

        // mod generator
        $modulename = 'choice';
        $cm = new stdClass();
        $cm->course             = $course_id;

        $cm->module             = $DB->get_field('modules', 'id', array('name'=>$modulename));
        $cm->instance           = 0;

        $cm->allowupdate        = $allowupdate;
        $cm->allowmultiple      = $allowmultiple;
        $cm->limitanswers       = $limitanswers;

        $cm->section            = $section;
        $cm->idnumber           = null;
        $cm->added              = time();
        $cm->id					= $DB->insert_record('course_modules', $cm);
    
        course_add_cm_to_section( $course_id, $cm->id, $section);
    
        $choice = new stdClass();
        $choice->modulename = 'choice';
        $choice->course = $course_id;

        $choice->module = $cm->module;
        $choice->name = $course_name;
        $choice->intro = $description;

        $choice->allowupdate = $allowupdate;
        $choice->allowmultiple = $allowmultiple;
        $choice->limitanswers = $limitanswers;

        $choice->coursemodule = $cm->id;

        $instance = choice_add_instance( $choice );

        $result_id = $instance;

        $DB->set_field('course_modules', 'instance', $instance, array('id'=> $choice->coursemodule ));

        $instance = $DB->get_record('choice', array('id'=>$instance), '*', MUST_EXIST);
        $cm = get_coursemodule_from_id('choice',  $choice->coursemodule, $instance->course, true, MUST_EXIST);
        context_module::instance($cm->id);
        rebuild_course_cache($course->id);
        /*add_to_log($course_id, "course", "add mod",
        "../../mod/$cm->modulename/view.php?id=$cm->id",
        "$cm->modulename $cm->instance");
        add_to_log($course_id, 'choice', "add",
        "view.php?id=$cm->coursemodule",
        "$cm->instance", $cm->id);*/

        $restriction = \core_availability\tree::get_root_json(
            [\availability_group\condition::get_json($group_id)]);
        $DB->set_field('course_modules', 'availability',
        json_encode($restriction), ['id' => $cm->id]);
        rebuild_course_cache($course_id, true);

        $warnings = array();

        $result = array();
        $result['id'] = $result_id;
        return $result;
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function handle_choice_returns() {

        return new external_single_structure(
            array(
                'id' => new external_value(PARAM_INT, 'Whether the user can do the quiz or not.'),
            )
        );

        return new external_value(PARAM_TEXT, 'The welcome message + user first name');
    }
}
