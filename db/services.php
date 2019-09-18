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
        'get_chat' => array(
                'classname'     => 'get_chat',
                'methodname'    => 'handle_chat',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/get/chat.php',
                'type'          => 'read',
        ),
        'get_data' => array(
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
        'get_wiki' => array(
                'classname'     => 'get_wiki',
                'methodname'    => 'handle_wiki',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/get/wiki.php',
                'type'          => 'read',
        ),

        'local_wstemplate_handle_chat' => array(
                'classname'     => 'local_wstemplate_external',
                'methodname'    => 'handle_chat',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/chat.php',
                'type'          => 'read',
        ),
        'update_chat' => array(
                'classname'     => 'update_chat',
                'methodname'    => 'handle_chat',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/update_chat.php',
                'type'          => 'read',
        ),
        'local_wstemplate_handle_data' => array(
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
        'local_wstemplate_handle_forum' => array(
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
        'local_wstemplate_handle_lti' => array(
                'classname'     => 'local_wstemplate_handle_lti',
                'methodname'    => 'handle_lti',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/extern_tool.php',
                'type'          => 'read',
        ),
        'update_extern_tool' => array(
                'classname'     => 'update_extern_tool',
                'methodname'    => 'handle_lti',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/update_extern_tool.php',
                'type'          => 'read',
        ),
        'local_wstemplate_handle_glossary' => array(
                'classname'     => 'glossario_wstemplate_external',
                'methodname'    => 'handle_glossary',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/glossario.php',
                'type'          => 'read',
        ),
        'update_glossario' => array(
                'classname'     => 'update_glossario',
                'methodname'    => 'handle_glossary',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/update_glossario.php',
                'type'          => 'read',
        ),
        'local_wstemplate_handle_wiki' => array(
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
        'local_wstemplate_handle_choice' => array(
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
        'local_wstemplate_handle_choice_option' => array(
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
        'local_wstemplate_handle_quiz' => array(
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

        
);

// We define the services to install as pre-build services. A pre-build service is not editable by administrator.
$services = array(
        'My service' => array(
                'functions' => array ('local_wstemplate_handle_chat','local_wstemplate_handle_data', 'local_wstemplate_handle_forum', 
                'local_wstemplate_handle_glossary', 'local_wstemplate_handle_wiki','local_wstemplate_handle_choice','local_wstemplate_handle_choice_option',
                'local_wstemplate_handle_quiz'
        ),
                'restrictedusers' => 0,
                'enabled'=>1,
        )
);

/*
'local_wstemplate_handle_assign',
                'local_wstemplate_handle_choice', 'local_wstemplate_handle_data', 'local_wstemplate_handle_lti','local_wstemplate_handle_feedback',
                'local_wstemplate_handle_forum','local_wstemplate_handle_glossary','local_wstemplate_handle_lesson','local_wstemplate_get_quizzes',
                'local_wstemplate_handle_survey',

   'local_wstemplate_handle_assign' => array(
                'classname'     => 'local_wstemplate_external',
                'methodname'    => 'handle_assign',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/assign.php',
                'type'          => 'read',
        ),
        'local_wstemplate_handle_choice' => array(
                'classname'   => 'local_wstemplate_external',
                'methodname'  => 'handle_choice',
                'classpath'   => 'local/wstemplate/ws/choice.php',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'type'        => 'read',
        ),

        'local_wstemplate_handle_data' => array(
                'classname'     => 'local_wstemplate_external',
                'methodname'    => 'handle_data',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/database.php',
                'type'          => 'read',
        ),
        'local_wstemplate_handle_lti' => array(
                'classname'     => 'local_wstemplate_external',
                'methodname'    => 'handle_lti',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/extern_tool.php',
                'type'          => 'read',
        ),
        'local_wstemplate_handle_feedback' => array(
                'classname'   => 'local_wstemplate_external',
                'methodname'  => 'handle_feedback',
                'classpath'   => 'local/wstemplate/ws/feedback.php',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'type'        => 'read',
        ),

        'local_wstemplate_handle_forum' => array(
                'classname'     => 'local_wstemplate_external',
                'methodname'    => 'handle_forum',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/forum.php',
                'type'          => 'read',
        ),
        'local_wstemplate_handle_glossary' => array(
                'classname'     => 'local_wstemplate_external',
                'methodname'    => 'handle_glossary',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/glossario.php',
                'type'          => 'read',
        ),
        'local_wstemplate_handle_lesson' => array(
                'classname'     => 'local_wstemplate_external',
                'methodname'    => 'handle_lesson',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/lesson.php',
                'type'          => 'read',
        ),
        'local_wstemplate_get_quizzes' => array(
                'classname'     => 'local_wstemplate_external',
                'methodname'    => 'get_quizzes',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/quiz.php',
                'type'          => 'read',
        ),
        'local_wstemplate_handle_survey' => array(
                'classname'     => 'local_wstemplate_external',
                'methodname'    => 'handle_survey',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'classpath'   => 'local/wstemplate/ws/survey.php',
                'type'          => 'read',
        ),
 */