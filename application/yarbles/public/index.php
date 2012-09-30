<?php
require_once('../../../vendor/yarbles/framework/common/YarblesLocator.php');
require_once('../../../vendor/yarbles/framework/ConfigInterface.php');
require_once('../../../vendor/yarbles/framework/Config.php');
require_once('../../../vendor/yarbles/framework/AutoloadInterface.php');
require_once('../../../vendor/yarbles/framework/Autoload.php');

use yarbles\framework\common\YarblesLocator;
use yarbles\framework\Config;
use yarbles\framework\Autoload;
use yarbles\framework\adapter\database\DatabaseAdapterLoader;

ini_set('memory_limit','3000M'); // 3GB
ini_set('session.gc_maxlifetime',7200); // 120 minutes
date_default_timezone_set("America/Los_Angeles");

// Configuration vars
define('DEFAULT_ENVIRONMENT', 'production');
define('APP_CONFIG_PATH', '../../../config/AppConfig.ini');
define('FRAMEWORK_CONFIG_PATH', '../../../config/FrameworkConfig.ini');

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

function __autoload($strClass) {
	Autoload::load($strClass);
}

$objFrontController = YarblesLocator::getFrontController();
$objFrontController->dispatch();