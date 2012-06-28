<?php

class Exception_Controller_ControllerNotFound extends Exception_Controller {
	protected $strControllerName;

	public function __construct($strControllerName) {
		$this->strControllerName = $strControllerName;
		parent::__construct('Controller Not Found');
	}

	public function getControllerName() {
		return $this->strControllerName;
	}

}