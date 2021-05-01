<?php


require_once($CFG->libdir . "/externallib.php");

require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . "/mod/quiz/lib.php");


class quiz_questions extends external_api
{

    public static function handle_quiz_questions_parameters()
    {
        return new external_function_parameters(
            array(
                'quizid' => new external_value(PARAM_INT, 'quiz id,', VALUE_DEFAULT, 'Quiz id'),
            )
        );
    }

    public static function handle_quiz_questions($quizid = '')
    {

        global $COURSE, $DB, $CFG;

        /*$params = self::validate_parameters(
            self::handle_quiz_questions_parameters(),
            array('quizid' => $quizid)
        );*/

        $sql = 'SELECT * FROM '.$CFG->prefix.'quiz_slots WHERE quizid = '.$quizid;
        $quiz_slots = $DB->get_records_sql($sql);

        $result = array();

        foreach ($quiz_slots as $slot) {
            $question = $DB->get_record('question', array('id' => $slot->questionid), '*', MUST_EXIST);
            $temp = array(
                'id' => $question->id,
                'name' => $question->name,
                'questiontext' => strip_tags($question->questiontext),
                'questiontextformat' => $question->questiontextformat,
                'qtype' => $question->qtype,
                'slot' => $slot->slot,
            );
            array_push( $result, $temp );
        }

        return $result;
    }

    public static function handle_quiz_questions_returns()
    {

        return new external_multiple_structure(
            new external_single_structure(
            array(
                'id' => new external_value(PARAM_INT, 'Question id.'),
                'name' => new external_value(PARAM_TEXT, 'Question name.'),
                'questiontext' => new external_value(PARAM_TEXT, 'Question text.'),
                'questiontextformat' => new external_value(PARAM_TEXT, 'Question text format.'),
                'qtype' => new external_value(PARAM_TEXT, 'Question type.'),
                'slot' => new external_value(PARAM_TEXT, 'Question type.'),

            )
            )
        );
    }
}
