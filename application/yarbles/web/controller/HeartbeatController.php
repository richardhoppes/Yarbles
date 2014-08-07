<?php
namespace yarbles\web\controller;

use yarbles\framework\Controller;
use yarbles\framework\helper\AppVersionHelper;
use yarbles\framework\helper\FrameworkVersionHelper;

class HeartbeatController extends BaseController
{
	public function main()
	{
		$arrDisplay = array(
			'status' => 'OK',
			'application' => $this->objConfig->getProperty("app_name"),
			'application_version' => AppVersionHelper::getFullVersion(), 
			'framework' => $this->objConfig->getProperty("fw_name"), 
			'framework_version' => FrameworkVersionHelper::getFullVersion()
		);
		$this->outputJson($arrDisplay);
	}
}