<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "users_interface";
$route['404_override'] = '';

/************************************************** CLIENT INTRERFACE ***********************************************/

$route['cabinet/profile']			= "clients_interface/profile";
$route['cabinet/return-register']	= "clients_interface/returnRegister";
$route['cabinet/ep-register-me'] 	= "clients_interface/EPRegisterME";

$route['cabinet/orders']			= "clients_interface/available_orders";
$route['cabinet/orders/from']		= "clients_interface/available_orders";
$route['cabinet/orders/from/:num']	= "clients_interface/available_orders";

/*************************************************** ADMINS INTRERFACE ***********************************************/

$route['admin-panel/actions/orders']				= "admin_interface/available_orders";
$route['admin-panel/actions/orders/from']			= "admin_interface/available_orders";
$route['admin-panel/actions/orders/from/:num']		= "admin_interface/available_orders";

$route['admin-panel/actions/orders/delete/id/:num']	= "admin_interface/delete_order";
$route['admin-panel/actions/orders/closed/id/:num']	= "admin_interface/closed_order";

$route['admin-panel/actions/forum']					= "admin_interface/forum";
$route['admin-panel/actions/forum/from']			= "admin_interface/forum";
$route['admin-panel/actions/forum/from/:num']		= "admin_interface/forum";

$route['admin-panel/actions/forum/save-text']		= "admin_interface/save_forum_text";

$route['admin-panel/actions/forum/delete-question/id/:num']	= "admin_interface/delete_question";
$route['admin-panel/actions/forum/delete-answer/id/:num']	= "admin_interface/delete_answer";

$route['admin-panel/actions/news']					= "admin_interface/news";
$route['admin-panel/actions/news/from']				= "admin_interface/news";
$route['admin-panel/actions/news/from/:num']		= "admin_interface/news";

$route['admin-panel/actions/news/add']				= "admin_interface/add_new";
$route['admin-panel/actions/news/edit/id/:num'] 	= "admin_interface/edit_news";
$route['admin-panel/actions/news/delete/id/:num'] 	= "admin_interface/delete_news";

$route['admin-panel/actions/users']					= "admin_interface/actions_users";
$route['admin-panel/actions/users/from']			= "admin_interface/actions_users";
$route['admin-panel/actions/users/from/:num']		= "admin_interface/actions_users";

$route['admin-panel/actions/users/add'] = "admin_interface/user_add";
$route['admin-panel/actions/users/edit/id/:num']	= "admin_interface/user_edit";
$route['admin-panel/actions/users/delete/id/:num'] = "admin_interface/user_delete";
$route['admin-panel/actions/profile'] = "admin_interface/actions_profile";
$route['admin-panel/actions/register/all-list'] = "admin_interface/full_register_list";
$route['admin-panel/actions/register'] = "admin_interface/register";
$route['admin-panel/actions/register/from'] = "admin_interface/register";
$route['admin-panel/actions/register/from/:num'] = "admin_interface/register";

$route['admin-panel/actions/register/add'] = "admin_interface/add_register";
$route['admin-panel/actions/register/edit/id/:num'] = "admin_interface/edit_register";
$route['admin-panel/actions/register/search'] = "admin_interface/search_register";
$route['admin-panel/actions/register/delete/id/:num'] = "admin_interface/delete_register";

$route['admin-panel/actions/register/import-csv'] = "admin_interface/import_csv";

$route['admin-panel/actions/return-register'] = "admin_interface/returnRegister";
$route['admin-panel/actions/ep-register-me'] = "admin_interface/EPRegisterME";

$route['admin-panel/actions/register/print/id/:num/covering-letter'] = "admin_interface/print_covering_letter";
$route['admin-panel/actions/register/print/id/:num/sample-notice'] = "admin_interface/print_sample_notice";
$route['admin-panel/actions/register/print/id/:num/covering-letter-pdf'] = "admin_interface/downloadCoveringLetter";

/*************************************************** USERS INTRERFACE ***********************************************/
$route['news']				= "users_interface/news";
$route['news/from']			= "users_interface/news";
$route['news/from/:num']	= "users_interface/news";

$route['forum']				= "users_interface/forum";
$route['forum/from']		= "users_interface/forum";
$route['forum/from/:num']	= "users_interface/forum";

$route['send-order']		= "users_interface/send_order";
$route['send-order-audit']	= "users_interface/send_order_audit";
$route['send-energy-passport']	= "users_interface/send_energy_passport";

$route['register-members']			= "users_interface/register_members";
$route['register-members/from']		= "users_interface/register_members";
$route['register-members/from/:num']= "users_interface/register_members";

$route['register-passports']			= "users_interface/register_passports";
$route['register-passports/from']		= "users_interface/register_passports";
$route['register-passports/from/:num']	= "users_interface/register_passports";

$route['login']				= "users_interface/login";
$route['logoff']			= "users_interface/logoff";
$route[':any']				= "users_interface/index";