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
 * Web service local plugin template external functions and service definitions.
 *
 * @package    localwstemplate
 * @copyright  2011 Jerome Mouneyrac
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// We defined the web service functions to install.
$functions = array(
        'get_course_grade_items' => array(
                'classname'     => 'get_course_grade_items_external',
                'methodname'    => 'handle_get_grade_items',
                'description' => 'Update module availability',
                'classpath'   => 'local/wstemplate/ws/get/get_grade_items.php',
                'type'          => 'read',
        ),
        'update_module_availability' => array(
                'classname'     => 'update_module_availability_external',
                'methodname'    => 'handle_update_module_availability',
                'description' => 'Update module availability',
                'classpath'   => 'local/wstemplate/ws/update/update_module_availability.php',
                'type'          => 'read',
        ),
        'get_course_module' => array(
                'classname'     => 'get_course_module_external',
                'methodname'    => 'handle_get_course_module',
                'description' => 'Get course module details',
                'classpath'   => 'local/wstemplate/ws/get/get_course_module.php',
                'type'          => 'read',
        ),
        'get_quiz_questions' => array(
                'classname'     => 'quiz_questions',
                'methodname'    => 'handle_quiz_questions',
                'description' => 'Get details about quiz questions',
                'classpath'   => 'local/wstemplate/ws/quiz/get_questions.php',
                'type'          => 'read',
        ),
        'count_log_events' => array(
                'classname'     => 'count_log_events_external',
                'methodname'    => 'count_log_events',
                'description' => 'Count number of events by course;',
                'classpath'   => 'local/wstemplate/ws/custom/count_log_events.php',
                'type'          => 'read',
        ),
        'get_grades_status' => array(
                'classname'     => 'get_grades_status_external',
                'methodname'    => 'get_grades_status',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/custom/get_grades_status.php',
                'type'          => 'read',
        ),
        'get_status' => array(
                'classname'     => 'get_status_external',
                'methodname'    => 'get_status',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/custom/get_status.php',
                'type'          => 'read',
        ),
        'group_chat' => array(
                'classname'     => 'group_chat_manager',
                'methodname'    => 'group_chat',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/group/chat.php',
                'type'          => 'read',
        ),
        'group_choice' => array(
                'classname'     => 'group_choice_manager',
                'methodname'    => 'group_choice',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/group/choice.php',
                'type'          => 'read',
        ),
        'group_data' => array(
                'classname'     => 'group_data_manager',
                'methodname'    => 'group_data',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/group/data.php',
                'type'          => 'read',
        ),
        'group_lti' => array(
                'classname'     => 'group_lti_manager',
                'methodname'    => 'group_lti',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/group/externtool.php',
                'type'          => 'read',
        ),
        'group_forum' => array(
                'classname'     => 'group_forum_manager',
                'methodname'    => 'group_forum',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/group/forum.php',
                'type'          => 'read',
        ),
        'group_glossary' => array(
                'classname'     => 'group_glossary_manager',
                'methodname'    => 'group_glossary',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/group/glossary.php',
                'type'          => 'read',
        ),
        'group_quiz' => array(
                'classname'     => 'group_quiz_manager',
                'methodname'    => 'group_quiz',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/group/quiz.php',
                'type'          => 'read',
        ),
        'group_wiki' => array(
                'classname'     => 'group_wiki_manager',
                'methodname'    => 'group_wiki',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/group/wiki.php',
                'type'          => 'read',
        ),
        'count_messages_by_user' => array(
                'classname'     => 'count_messages_by_user',
                'methodname'    => 'count_messages',
                'description' => 'Return number of chat messages by userid',
                'classpath'   => 'local/wstemplate/ws/custom/count_messages_by_user.php',
                'type'          => 'read',
        ),
        'get_chat' => array(
                'classname'     => 'get_chat',
                'methodname'    => 'handle_chat',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/get/chat.php',
                'type'          => 'read',
        ),
        'get_glossary' => array(
                'classname'     => 'get_glossary',
                'methodname'    => 'handle_glossary',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/get/get_glossary.php',
                'type'          => 'read',
        ),
        'get_choice' => array(
                'classname'     => 'get_choice',
                'methodname'    => 'handle_choice',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/get/choice.php',
                'type'          => 'read',
        ),
        'get_database' => array(
                'classname'     => 'get_data',
                'methodname'    => 'handle_data',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/get/database.php',
                'type'          => 'read',
        ),
        'get_forum' => array(
                'classname'     => 'get_forum',
                'methodname'    => 'handle_forum',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/get/forum.php',
                'type'          => 'read',
        ),
        'get_lti' => array(
                'classname'     => 'get_lti',
                'methodname'    => 'handle_lti',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/get/externtool.php',
                'type'          => 'read',
        ),
        'get_quiz' => array(
                'classname'     => 'get_quiz',
                'methodname'    => 'handle_quiz',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/get/quiz.php',
                'type'          => 'read',
        ),
        'get_lesson' => array(
                'classname'     => 'get_lesson',
                'methodname'    => 'handle_lesson',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/get/lesson.php',
                'type'          => 'read',
        ),
        'get_wiki' => array(
                'classname'     => 'get_wiki',
                'methodname'    => 'handle_wiki',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/get/wiki.php',
                'type'          => 'read',
        ),
        'create_chat' => array(
                'classname'     => 'atid_tools_external',
                'methodname'    => 'handle_chat',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/chat.php',
                'type'          => 'read',
        ),
        'create_lesson' => array(
                'classname'     => 'create_lesson',
                'methodname'    => 'handle_lesson',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/lesson.php',
                'type'          => 'read',
        ),
        'update_chat' => array(
                'classname'     => 'update_chat',
                'methodname'    => 'handle_chat',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/update_chat.php',
                'type'          => 'read',
        ),
        'create_database' => array(
                'classname'     => 'database_wstemplate_external',
                'methodname'    => 'handle_data',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/database.php',
                'type'          => 'read',
        ),
        'update_database' => array(
                'classname'     => 'update_database',
                'methodname'    => 'handle_data',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/update_database.php',
                'type'          => 'read',
        ),
        'create_forum' => array(
                'classname'     => 'forum_wstemplate_external',
                'methodname'    => 'handle_forum',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/forum.php',
                'type'          => 'read',
        ),
        'update_forum' => array(
                'classname'     => 'update_forum',
                'methodname'    => 'handle_forum',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/update_forum.php',
                'type'          => 'read',
        ),
        'update_lesson' => array(
                'classname'     => 'update_lesson',
                'methodname'    => 'handle_lesson',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/update/update_lesson.php',
                'type'          => 'read',
        ),
        'create_lti' => array(
                'classname'     => 'atid_tools_handle_lti',
                'methodname'    => 'handle_lti',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/extern_tool.php',
                'type'          => 'read',
        ),
        'update_lti' => array(
                'classname'     => 'update_extern_tool',
                'methodname'    => 'handle_lti',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/update_extern_tool.php',
                'type'          => 'read',
        ),
        'create_glossary' => array(
                'classname'     => 'glossario_wstemplate_external',
                'methodname'    => 'handle_glossary',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/glossario.php',
                'type'          => 'read',
        ),
        'update_glossary' => array(
                'classname'     => 'update_glossario',
                'methodname'    => 'handle_glossary',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/update_glossario.php',
                'type'          => 'read',
        ),
        'create_wiki' => array(
                'classname'     => 'wiki_wstemplate_external',
                'methodname'    => 'handle_wiki',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/wiki.php',
                'type'          => 'read',
        ),
        'update_wiki' => array(
                'classname'     => 'update_wiki',
                'methodname'    => 'handle_wiki',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/update_wiki.php',
                'type'          => 'read',
        ),
        'create_choice' => array(
                'classname'   => 'choice_wstemplate_external',
                'methodname'  => 'handle_choice',
                'classpath'   => 'local/wstemplate/ws/choice.php',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'type'        => 'read',
        ),
        'update_choice' => array(
                'classname'   => 'update_choice',
                'methodname'  => 'handle_choice',
                'classpath'   => 'local/wstemplate/ws/update_choice.php',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'type'        => 'read',
        ),
        'create_choice_option' => array(
                'classname'   => 'choice_option_wstemplate_external',
                'methodname'  => 'handle_choice_options',
                'classpath'   => 'local/wstemplate/ws/choice_option.php',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'type'        => 'read',
        ),
        'update_choice_option' => array(
                'classname'   => 'update_choice_option',
                'methodname'  => 'handle_choice_options',
                'classpath'   => 'local/wstemplate/ws/update_choice_option.php',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'type'        => 'read',
        ),
        'create_quiz' => array(
                'classname'   => 'quiz_wstemplate_external',
                'methodname'  => 'get_quizzes',
                'classpath'   => 'local/wstemplate/ws/quiz.php',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'type'        => 'read',
        ),
        'update_quiz' => array(
                'classname'   => 'update_quiz',
                'methodname'  => 'get_quizzes',
                'classpath'   => 'local/wstemplate/ws/update_quiz.php',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'type'        => 'read',
        ),
        'delete_quiz' => array(
                'classname'   => 'delete_quiz_manager',
                'methodname'  => 'delete_quiz',
                'classpath'   => 'local/wstemplate/ws/delete_quiz_manager.php',
                'description' => 'Delete quiz activity by id parameter.',
                'type'        => 'read',
        ),
        'delete_forum' => array(
                'classname'   => 'delete_forum_manager',
                'methodname'  => 'delete_forum',
                'classpath'   => 'local/wstemplate/ws/delete_forum_manager.php',
                'description' => 'Delete forum activity by id parameter.',
                'type'        => 'read',
        ),
        'delete_chat' => array(
                'classname'   => 'delete_chat_manager',
                'methodname'  => 'delete_chat',
                'classpath'   => 'local/wstemplate/ws/delete_chat_manager.php',
                'description' => 'Delete chat activity by id parameter.',
                'type'        => 'read',
        ),
        'delete_lesson' => array(
                'classname'   => 'delete_lesson_manager',
                'methodname'  => 'delete_lesson',
                'classpath'   => 'local/wstemplate/ws/delete/delete_lesson_manager.php',
                'description' => 'Delete lesson activity by id parameter.',
                'type'        => 'read',
        ),
        'delete_lti' => array(
                'classname'   => 'delete_lti_manager',
                'methodname'  => 'delete_lti',
                'classpath'   => 'local/wstemplate/ws/delete/delete_lti_manager.php',
                'description' => 'Delete lti activity by id parameter.',
                'type'        => 'read',
        ),
        'delete_database' => array(
                'classname'   => 'delete_database_manager',
                'methodname'  => 'delete_database',
                'classpath'   => 'local/wstemplate/ws/delete/delete_database_manager.php',
                'description' => 'Delete database activity by id parameter.',
                'type'        => 'read',
        ),
        'delete_choice' => array(
                'classname'   => 'delete_choice_manager',
                'methodname'  => 'delete_choice',
                'classpath'   => 'local/wstemplate/ws/delete/delete_choice_manager.php',
                'description' => 'Delete choice activity by id parameter.',
                'type'        => 'read',
        ),
        'delete_wiki' => array(
                'classname'   => 'delete_wiki_manager',
                'methodname'  => 'delete_wiki',
                'classpath'   => 'local/wstemplate/ws/delete/delete_wiki_manager.php',
                'description' => 'Delete wiki activity by id parameter.',
                'type'        => 'read',
        ),
        'delete_glossary' => array(
                'classname'   => 'delete_glossary_manager',
                'methodname'  => 'delete_glossary',
                'classpath'   => 'local/wstemplate/ws/delete/delete_glossary_manager.php',
                'description' => 'Delete glossary activity by id parameter.',
                'type'        => 'read',
        ),
        'get_modules_from_course' => array(
                'classname'   => 'get_modules_from_course',
                'methodname'  => 'handle_course_module',
                'classpath'   => 'local/wstemplate/ws/get/get_modules_from_course.php',
                'description' => 'get course sections from course id.',
                'type'        => 'read',
        ),
);

// We define the services to install as pre-build services. A pre-build service is not editable by administrator.
$services = array(
        'My service' => array(
                'functions' => array(
                        'create_chat', 'create_data', 'create_forum',
                        'create_glossary', 'create_wiki', 'create_choice', 'create_choice_option',
                        'create_quiz'
                ),
                'restrictedusers' => 0,
                'enabled' => 1,
        )
);

/*
'atid_tools_handle_assign',
                'create_choice', 'create_data', 'atid_tools_handle_lti','atid_tools_handle_feedback',
                'create_forum','create_glossary','atid_tools_handle_lesson','atid_tools_get_quizzes',
                'atid_tools_handle_survey',

   'atid_tools_handle_assign' => array(
                'classname'     => 'atid_tools_external',
                'methodname'    => 'handle_assign',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/assign.php',
                'type'          => 'read',
        ),
        'create_choice' => array(
                'classname'   => 'atid_tools_external',
                'methodname'  => 'handle_choice',
                'classpath'   => 'local/wstemplate/ws/choice.php',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'type'        => 'read',
        ),

        'create_data' => array(
                'classname'     => 'atid_tools_external',
                'methodname'    => 'handle_data',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/database.php',
                'type'          => 'read',
        ),
        'atid_tools_handle_lti' => array(
                'classname'     => 'atid_tools_external',
                'methodname'    => 'handle_lti',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/extern_tool.php',
                'type'          => 'read',
        ),
        'atid_tools_handle_feedback' => array(
                'classname'   => 'atid_tools_external',
                'methodname'  => 'handle_feedback',
                'classpath'   => 'local/wstemplate/ws/feedback.php',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'type'        => 'read',
        ),

        'create_forum' => array(
                'classname'     => 'atid_tools_external',
                'methodname'    => 'handle_forum',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/forum.php',
                'type'          => 'read',
        ),
        'create_glossary' => array(
                'classname'     => 'atid_tools_external',
                'methodname'    => 'handle_glossary',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/glossario.php',
                'type'          => 'read',
        ),
        'atid_tools_handle_lesson' => array(
                'classname'     => 'atid_tools_external',
                'methodname'    => 'handle_lesson',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/lesson.php',
                'type'          => 'read',
        ),
        'atid_tools_get_quizzes' => array(
                'classname'     => 'atid_tools_external',
                'methodname'    => 'get_quizzes',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/quiz.php',
                'type'          => 'read',
        ),
        'atid_tools_handle_survey' => array(
                'classname'     => 'atid_tools_external',
                'methodname'    => 'handle_survey',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/survey.php',
                'type'          => 'read',
        ),
 */