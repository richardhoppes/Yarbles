<?php
/**
 * Controller not found exception
 * @author Richard Hoppes <rhoppes@gmail.com>
 */
class Exception_Controller_ControllerNotFound extends Exception_Controller {
	protected $strInfo;

	public function __construct($strInfo = null) {
		$strInfo ? $this->strInfo = $strInfo : null;
		parent::__construct('Controller Not Found');
	}

	public function getStrInfo() {
		return $this->strInfo;
	}

	public function setStrInfo($strInfo) {
		$this->strInfo = $strInfo;
	}
}