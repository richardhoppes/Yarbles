<?php

/*
|--------------------------------------------------------------------------
| Pre boot
|--------------------------------------------------------------------------
|
| Initial setup.
|
| Include config, locator and autoloader.  Also setup defaults for
| memory limits, timezone, environment and config file paths.
|
|--------------------------------------------------------------------------
*/

require_once(__DIR__ . '/../../../config/pre-boot.php');

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

if(preg_match('/webdev\./i', $_SERVER['SERVER_NAME'])) {
	define('ENVIRONMENT', 'development');
} else {
	define('ENVIRONMENT', 'production');
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

/*
|--------------------------------------------------------------------------
| Post boot
|--------------------------------------------------------------------------
|
| Set up autoloader, dispatch front controller.
|
|--------------------------------------------------------------------------
*/

require_once(__DIR__ . '/../../../config/post-boot.php');