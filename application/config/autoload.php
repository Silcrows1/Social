<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('form_validation', 'session');

$autoload['drivers'] = array();

$autoload['helper'] = array('url', 'form', 'text', 'email', 'security');

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array('post_model', 'category_model', 'comment_model', 'user_model');
