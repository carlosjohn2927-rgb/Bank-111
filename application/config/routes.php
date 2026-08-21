<?php defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller']='home';
$route['login']='auth/login'; $route['register']='auth/register'; $route['logout']='auth/logout';
$route['forgot-password']='auth/forgot_password';
$route['dashboard']='dashboard/index'; $route['transfers']='dashboard/transfers'; $route['cards']='dashboard/cards'; $route['cards/request']='dashboard/request_card'; $route['profile']='dashboard/profile'; $route['kyc']='dashboard/kyc'; $route['loans']='dashboard/loans';
$route['admin/login']='admin/login'; $route['admin/logout']='admin/logout'; $route['admin']='admin/index';
$route['admin/users']='admin/users'; $route['admin/users/create']='admin/create_user'; $route['admin/users/(:num)/(:any)']='admin/update_user_status/$1/$2'; $route['admin/kyc']='admin/kyc'; $route['admin/deposits']='admin/deposits'; $route['admin/transfers']='admin/transfers'; $route['admin/loans']='admin/loans'; $route['admin/cards']='admin/cards'; $route['admin/card-applications']='admin/card_applications'; $route['admin/managers']='admin/managers'; $route['admin/audit-log']='admin/audit_log'; $route['admin/managers/create']='admin/create_manager';
$route['admin/(:any)/(:num)/(:any)']='admin/update_status/$1/$2/$3';
$route['404_override']=''; $route['translate_uri_dashes']=FALSE;
