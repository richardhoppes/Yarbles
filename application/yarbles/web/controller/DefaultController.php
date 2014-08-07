<?php
namespace yarbles\web\controller;

use yarbles\framework\Controller;

class DefaultController extends BaseController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function main()
	{
		$this->loadHeader();
		$this->loadView('default', array('title', 'Hello World!'));
		$this->loadFooter();
	}
}