<?php
ini_set('memory_limit','3000M');                    // 3GB
ini_set('session.gc_maxlifetime',7200);             // 120 minutes
date_default_timezone_set("America/Los_Angeles");   // PHP can be so dumb


// Configuration vars
define('DEFAULT_ENVIRONMENT', 'production');
define('CONFIG_PATH', '../config/config.ini');

// Look at url, set env
if(preg_match('/webdev\./i', $_SERVER['SERVER_NAME'])) {
    define('ENVIRONMENT', 'development');
} else {
    define('ENVIRONMENT', 'production');
}

// Error reporting per environment
if(ENVIRONMENT == 'development') {
    error_reporting(E_ALL ^ E_NOTICE);
}

// Init config class
include_once('../../framework/Config.class.php');
$objConfig = Config::getHandle();


// Auto loading
include_once('../../framework/Autoload.class.php');
function __autoload($strClass) {
    Autoload::load($strClass);
}


// Load external libraries here
include_once($objConfig->EXT_PATH . "/Json.ext.php");
include_once($objConfig->EXT_PATH . "/OAuth.ext.php");


// All systems GO GO GO!
FrontController::run();
