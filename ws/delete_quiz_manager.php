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
require_once($CFG->dirroot . "/mod/quiz/lib.php");

require_once($CFG->dirroot . '/calendar/lib.php');


class delete_quiz_manager extends external_api
{

    /**
     * Returns description of method result value
     * @return external_function_parameters
     */
    public static function delete_quiz_parameters()
    {
        return new external_function_parameters(
            array(
                'quiz_id' => new external_value(PARAM_INT, 'quiz id', VALUE_DEFAULT, 'Hello world, '),
            )
        );
    }

    public static function delete_quiz($quiz_id)
    {

        global $DB;

        if (!$quiz = $DB->get_record('quiz', array('id' => $quiz_id))) {
            $result = array();
            $result['sucess'] = false;
            return $result;
        }

        quiz_delete_all_attempts($quiz);
        quiz_delete_all_overrides($quiz);

        $events = $DB->get_records('event', array('modulename' => 'quiz', 'instance' => $quiz->id));
        foreach ($events as $event) {
            $event = calendar_event::load($event);
            $event->delete();
        }

        quiz_grade_item_delete($quiz);
        $DB->delete_records('quiz', array('id' => $quiz->id));


        $result = array();
        $result['sucess'] = true;
        return $result;
    }

    public static function delete_quiz_returns()
    {

        return new external_single_structure(
            array(
                'sucess' => new external_value(PARAM_BOOL, 'Whether the user can do the quiz or not.'),
            )
        );
        return new external_value(PARAM_TEXT, 'The welcome message + user first name');
    }
}
