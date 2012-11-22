<?php

// Include pre-bootstrap setup
require_once('../../../config/pre-boot.php');

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

// Include post-bootstrap setup
require_once('../../../config/post-boot.php');