<?php

if ($_SERVER['APPLICATION_ENV'] == 'development') {
     error_reporting(E_ALL);
     ini_set("display_errors", 1);
}
 
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Composer autoloading
if (file_exists('vendor/autoload.php')) {
    $loader = require_once 'vendor/autoload.php';
}

// Run the application
Shopreview\Mvc\Application::getInstance(require_once 'config/application.config.php')
    ->run()
;
