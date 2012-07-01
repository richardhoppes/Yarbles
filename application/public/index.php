<?php
include_once('../../framework/main/com/simplephp/core/ConfigInterface.php');
include_once('../../framework/main/com/simplephp/core/Config.php');
include_once('../../framework/main/com/simplephp/core/AutoloadInterface.php');
include_once('../../framework/main/com/simplephp/core/Autoload.php');

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

// Declare globals for injecting dependencies
// TODO: Possibly replace this with something similar to spring mvc injection
$GLOBALS['config'] = Config::getHandle();
$GLOBALS['mysqlReadOnly'] = DatabaseAdapterLoader::getHandle(
	$GLOBALS['config']->getProperty("mysql_readonly_database_adapter"),
	$GLOBALS['config']->getProperty("mysql_readonly_database_server"),
	$GLOBALS['config']->getProperty("mysql_readonly_database_username"),
	$GLOBALS['config']->getProperty("mysql_readonly_database_password"),
	$GLOBALS['config']->getProperty("mysql_readonly_database_name")
);
$GLOBALS['mysqlReadWrite'] = DatabaseAdapterLoader::getHandle(
	$GLOBALS['config']->getProperty("mysql_readwrite_database_adapter"),
	$GLOBALS['config']->getProperty("mysql_readwrite_database_server"),
	$GLOBALS['config']->getProperty("mysql_readwrite_database_username"),
	$GLOBALS['config']->getProperty("mysql_readwrite_database_password"),
	$GLOBALS['config']->getProperty("mysql_readwrite_database_name")
);

// Set things up for dependency injection
// TODO: Find a better way to do this
function __autoload($strClass) {
	Autoload::load($strClass, $GLOBALS['config']);
}

$objFrontController = new FrontController($GLOBALS['config']);
$objFrontController->run();