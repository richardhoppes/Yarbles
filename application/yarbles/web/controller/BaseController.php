<?php
namespace yarbles\web\controller;

use yarbles\framework\common\YarblesLocator;
use yarbles\framework\Controller;
use yarbles\framework\helper\AppVersionHelper;
use yarbles\framework\helper\FrameworkVersionHelper;
use yarbles\web\common\ServiceLocator;

class BaseController extends Controller
{
	private $dblTimeStart;
	protected $objConfig;

	public function __construct()
	{
		$this->objConfig = YarblesLocator::getConfig();
		$this->dblTimeStart = microtime(true);

		parent::__construct();
	}

	protected function getTimeElapsed()
	{
		return microtime(true) - $this->dblTimeStart;
	}

	protected function loadHeader($strTitle = null)
	{
		$strSiteTitle = $this->objConfig->getProperty('site_title');
		$strSiteName = $this->objConfig->getProperty('site_name');

		if($strTitle != null) {
			$this->loadView('common/header', array('title' => $strTitle, 'siteTitle' => $strSiteTitle, 'siteName' => $strSiteName));
		} else {
			$this->loadView('common/header', array('siteTitle' => $strSiteTitle, 'siteName' => $strSiteName));
		}
	}

	protected function loadFooter()
	{
		$arrParams = array(
			'siteCopyright' => $this->objConfig->getProperty('site_copyright'),
		);

		$this->loadView('Common/Footer', $arrParams);
	}
}