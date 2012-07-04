<?php
namespace com\simplephp\web\controller;

use com\simplephp\web\model\CompanyModel;
use com\simplephp\web\entity\CompanyEntity;
use com\simplephp\web\model\PersonModel;
use com\simplephp\web\entity\PersonEntity;
use com\simplephp\web\model\TitleModel;
use com\simplephp\web\entity\TitleEntity;

class HomeController extends BaseController {

	public function main() {
		$this->loadView('home_main');
	}

}