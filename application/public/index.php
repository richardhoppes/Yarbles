<?php
include_once('../../application/main/com/simplephp/web/common/ServiceLocatorInterface.php');
include_once('../../application/main/com/simplephp/web/common/ServiceLocator.php');
include_once('../../framework/main/com/simplephp/core/ConfigInterface.php');
include_once('../../framework/main/com/simplephp/core/Config.php');
include_once('../../framework/main/com/simplephp/core/AutoloadInterface.php');
include_once('../../framework/main/com/simplephp/core/Autoload.php');


use com\simplephp\web\common\ServiceLocator;
use com\simplephp\core\Config;
use com\simplephp\core\Autoload;
use com\simplephp\core\FrontController;
use com\simplephp\core\adapter\database\DatabaseAdapterLoader;

ini_set('memory_limit','3000M'); // 3GB
ini_set('session.gc_maxlifetime',7200); // 120 minutes
date_default_timezone_set("America/Los_Angeles"); // PHP can be so dumb

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

// Get config once before using the autoloader
ServiceLocator::getConfig();

// Set things up for dependency injection
// TODO: Find a better way to do this
function __autoload($strClass) {
	Autoload::load($strClass);
}

$objFrontController = new FrontController();
$objFrontController->dispatch();