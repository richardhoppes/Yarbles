<?php
namespace com\simplephp\web\controller;

class HomeController extends BaseController {

	public function main() {
		$this->loadView('home_main');
	}

}