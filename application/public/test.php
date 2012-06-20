<?php
ini_set('memory_limit','3000M');                    // 3GB
ini_set('session.gc_maxlifetime',7200);             // 120 minutes
date_default_timezone_set("America/Los_Angeles");   // PHP can be so dumb
error_reporting(E_ALL ^ E_NOTICE);

define('DEFAULT_ENVIRONMENT', 'production');
define('ENVIRONMENT', 'development');
define('CONFIG_PATH', '../config/config.ini');

// Config
include_once('../../framework/php/Config.class.php');
$objConfig = Config::getHandle();

// Autoload
include_once('../../framework/php/Autoload.class.php');
function __autoload($strClass) {
    Autoload::load($strClass);
}

// Tests
require_once($objConfig->EXT_PATH . '/simpletest/autorun.php');
include_once($objConfig->FW_TEST_PATH . "/Service/Tmdb/SearchTest.class.php");
include_once($objConfig->FW_TEST_PATH . "/Service/Tmdb/Utility/TransformSearchResponseTest.class.php");
?>