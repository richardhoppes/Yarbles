<?php
namespace yarbles\framework\exception\controller;

use yarbles\framework\exception\controller\BaseControllerException;

class ControllerNotFoundException extends BaseControllerException {
	protected $strControllerName;

	public function __construct($strControllerName) {
		$this->strControllerName = $strControllerName;
		parent::__construct("Controller Not Found");
	}

	public function getControllerName() {
		return $this->strControllerName;
	}

}