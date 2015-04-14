<?php

if ($_SERVER['APPLICATION_ENV'] == 'development') {
     error_reporting(E_ALL);
     ini_set("display_errors", 1);
}

define('DS', DIRECTORY_SEPARATOR);
 
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Compatibility with the password_* functions being worked on for PHP 5.5
// https://github.com/ircmaxell/password_compat
require_once 'src/Password.php';

// Composer autoloading
if (file_exists('vendor/autoload.php')) {
    $loader = require_once 'vendor/autoload.php';
} else {
    exit('PSR-4 autoloader not found. Please use composer or provide one in 
        the \'vendor/\' directory.');
}

// Run the application
Shopreview\Mvc\Application::getInstance(require_once 'config/application.config.php')
    ->run()
;
