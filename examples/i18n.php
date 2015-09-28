<?php

// load the class
require_once '../src/I18n.php';

// use class
use WebSupportDK\PHPMultilingual\I18n;

// make language files in form of array in path/to/language/en/US.php, en/UK.php etc
return array(
    'VIEW_TEST' => 'This is a test!'
);

// set the local for the class in form of "en_US"
I18n::set($locale = 'en_US');

// register alle the locations of the language files with a token
I18n::register($path = 'path/to/language', $token = 'test');

// return the string of the language with the token
I18n::get($key = 'VIEW_TEST', $token = 'test');

// output/echo the string
I18n::output($key = 'VIEW_TEST', $token = 'test');
