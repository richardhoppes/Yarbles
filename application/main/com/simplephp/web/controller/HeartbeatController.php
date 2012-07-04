<?php
namespace com\simplephp\web\controller;

use com\simplephp\core\helper\VersionHelper;

class HeartbeatController extends BaseController {

	public function main() {
		$arrDisplay = array(
			'status' => 'OK',
			'application' => $this->objConfig->getProperty("app_name"),
			'version' => VersionHelper::getVersion($this->objConfig),
			'full_version' => VersionHelper::getFullVersion($this->objConfig)
		);
		$this->outputJson($arrDisplay);
	}

}