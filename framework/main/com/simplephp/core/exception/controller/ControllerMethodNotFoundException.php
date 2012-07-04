<?php
namespace com\simplephp\core\exception\controller;

use com\simplephp\core\exception\controller\BaseControllerException;

class ControllerMethodNotFoundException extends BaseControllerException {
	protected $strControllerMethodName;

	protected $strControllerName;

	public function __construct($strControllerMethodName, $strControllerName) {
		$this->strControllerMethodName = $strControllerMethodName;
		$this->strControllerName = $strControllerName;
		parent::__construct('Controller Method Not Found');
	}

	public function getControllerMethodName() {
		return $this->strControllerMethodName;
	}

}