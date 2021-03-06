<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['Users/(:any)'] = 'Users/viewUser/$1';
$route['users/Editprofile/(:any)'] = 'Users/editUser/$1';
$route['users/Editpassword/(:any)'] = 'Users/updatePassword/$1';
$route['searches'] = 'posts/search';
$route['posts/create'] = 'posts/create';
$route['posts/update'] = 'posts/update';
$route['posts/(:any)'] = 'posts/view/$1';
$route['posts'] = 'posts/index';
$route['default_controller'] = 'pages/view';
$route['categories'] = 'categories/index';
$route['categories/create'] = 'categories/create';
$route['categories/post/(:any)'] = 'categories/posts/$1';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
