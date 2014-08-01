<?php
namespace yarbles\web\controller;

use yarbles\framework\Controller;
use yarbles\framework\helper\AppVersionHelper;
use yarbles\framework\helper\FrameworkVersionHelper;
use yarbles\web\common\CacheLocator;
use yarbles\web\common\DatabaseLocator;

class HeartbeatController extends Controller {

	public function main() {
		$arrDisplay = array(
			'status' => 'OK',
			'application' => $this->objConfig->getProperty("app_name"),
			'application_version' => AppVersionHelper::getFullVersion(), 
			'framework' => $this->objConfig->getProperty("fw_name"), 
			'framework_version' => FrameworkVersionHelper::getFullVersion()
		);
		$this->outputJson($arrDisplay);
	}

	public function databasetest() {
		$objDatabase = DatabaseLocator::getReadWriteDatabase();
		$arrResults = $objDatabase->query("SELECT unix_timestamp()");

		echo "<pre>";
		print_r($arrResults);
		echo "</pre>";
	}

	public function cachetest() {
		$objCache = CacheLocator::getCache();

		$arrOutput = array();
		$arrOutput['available_bytes'] = $objCache->getAvailableBytes();
		$arrOutput['total_bytes'] = $objCache->getTotalBytes();

		echo "<pre>";
		print_r($arrOutput);
		print_r($objCache->dumpStats());
		echo "<pre>";
	}

}