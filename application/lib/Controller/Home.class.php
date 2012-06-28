<?php

class Controller_Home extends Controller_Base
{
	public function __construct() {
		parent::__construct();
	}

	public function main() {
		$config = Config::getHandle();
		echo $config->app_name . " (v" . Helper_Version::getFullVersion() . ")";
	}
}