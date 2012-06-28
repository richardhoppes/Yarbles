<?php

class Controller_Heartbeat extends Controller_Base
{
	public function __construct() {
		parent::__construct();
	}

	public function main() {
		$config = Config::getHandle();

		$display = array(
			'status' => 'OK',
			'application' => $config->app_name,
			'version' => Helper_Version::getVersion(),
			'full_version' => Helper_Version::getFullVersion()
		);

		echo json_encode($display);
	}

}