<?php
require_once(__DIR__ . '/../vendor/yarbles/framework/ConfigInterface.php');
require_once(__DIR__ . '/../vendor/yarbles/framework/Config.php');
require_once(__DIR__ . '/../vendor/yarbles/framework/common/YarblesLocator.php');
require_once(__DIR__ . '/../vendor/yarbles/framework/AutoloadInterface.php');
require_once(__DIR__ . '/../vendor/yarbles/framework/Autoload.php');

/*
|--------------------------------------------------------------------------
| PHP defaults
|--------------------------------------------------------------------------
|
| Memory limits, session lifetime, default timezones, etc...
|
|--------------------------------------------------------------------------
*/

ini_set('memory_limit','3000M'); // 3GB
ini_set('session.gc_maxlifetime',7200); // 120 minutes
date_default_timezone_set("America/Los_Angeles");

/*
|--------------------------------------------------------------------------
| Config paths
|--------------------------------------------------------------------------
|
| Paths to application and framework configuration files.
|
|--------------------------------------------------------------------------
*/

define('APP_CONFIG_PATH', '../../../config/AppConfig.ini');
define('FRAMEWORK_CONFIG_PATH', '../../../config/FrameworkConfig.ini');

/*
|--------------------------------------------------------------------------
| Environment
|--------------------------------------------------------------------------
|
| Write custom code here for determining environment here.
|
| Framework will look at the application config file path in pre-boot.php,
| and look there for a .ini file with the environment name
| (e.g. development will load <APP_CONFIG_PATH>/development.ini
|
|--------------------------------------------------------------------------
*/

define('DEFAULT_ENVIRONMENT', 'production');

if(preg_match('/webdev\./i', $_SERVER['SERVER_NAME'])) {
	define('ENVIRONMENT', 'development');
} else {
	define('ENVIRONMENT', DEFAULT_ENVIRONMENT);
}

/*
|--------------------------------------------------------------------------
| Error reporting
|--------------------------------------------------------------------------
|
| Optional way to override error reporting for specific environment(s).
|
|--------------------------------------------------------------------------
*/

if(ENVIRONMENT == 'development') {
	error_reporting(E_ALL ^ E_NOTICE);
}