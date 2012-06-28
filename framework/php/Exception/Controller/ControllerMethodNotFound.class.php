<?php

class Exception_Controller_ControllerMethodNotFound extends Exception_Controller {
	protected $strControllerMethodName;

	public function __construct($strControllerMethodName) {
		$this->strControllerMethodName = $strControllerMethodName;
		parent::__construct('Controller Method Not Found');
	}

	public function getControllerMethodName() {
		return $this->strControllerMethodName;
	}

}