<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'home';
$route['login'] = 'user/login';
$route['register'] = 'user/register';
$route['profile'] = 'user/profile';
$route['delete_account'] = 'user/delete_account';
$route['ask_question'] = 'home/ask_question';
$route['mark_as_solved/(:any)'] = 'question/mark_as_solved/$1';
$route['question/view/(:any)'] = 'question/view_question/$1';
$route['question/view/(:any)/display_answer_form'] = 'question/display_answer_form/$1';
$route['question/view/(:any)/answer/submit'] = 'question/answer_question/$1';
$route['question/(:any)/answer/(:any)/vote/(:any)'] = 'vote/vote_answer';
$route['404_override'] = 'home';
$route['translate_uri_dashes'] = FALSE;
