<?php
require_once(__DIR__ . '/../vendor/yarbles/framework/ConfigInterface.php');
require_once(__DIR__ . '/../vendor/yarbles/framework/Config.php');
require_once(__DIR__ . '/../vendor/yarbles/framework/common/YarblesLocator.php');
require_once(__DIR__ . '/../vendor/yarbles/framework/AutoloadInterface.php');
require_once(__DIR__ . '/../vendor/yarbles/framework/Autoload.php');

ini_set('memory_limit','3000M'); // 3GB
ini_set('session.gc_maxlifetime',7200); // 120 minutes
date_default_timezone_set("America/Los_Angeles");

// Configuration vars
define('DEFAULT_ENVIRONMENT', 'production');
define('APP_CONFIG_PATH', '../../../config/AppConfig.ini');
define('FRAMEWORK_CONFIG_PATH', '../../../config/FrameworkConfig.ini');