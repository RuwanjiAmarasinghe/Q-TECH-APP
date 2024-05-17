<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'home';
$route['login'] = 'user/login';
$route['register'] = 'user/register';
$route['profile'] = 'user/profile';
$route['ask_question'] = 'home/ask_question';
$route['solved_question/(:any)'] = 'question/solved_question/$1';
$route['question/view/(:any)'] = 'question/view_question/$1';
$route['question/view/(:any)/viewTheAnswerForm'] = 'question/viewTheAnswerForm/$1';
$route['question/view/(:any)/answer/submit'] = 'question/answer_question/$1';
$route['question/(:any)/answer/(:any)/vote/(:any)'] = 'vote/votes_given';
$route['404_override'] = 'home';
$route['translate_uri_dashes'] = FALSE;
