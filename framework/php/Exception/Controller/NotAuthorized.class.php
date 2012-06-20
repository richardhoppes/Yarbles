<?php
/**
 * Not authorized exception
 * @author Richard Hoppes <rhoppes@gmail.com>
 */
class Exception_Controller_NotAuthorized extends Exception_Controller {
	protected $strInfo;

	public function __construct($strInfo = null) {
		$strInfo ? $this->strInfo = $strInfo : null;
		parent::__construct('Not Authorized');
	}

	public function getStrInfo() {
		return $this->strInfo;
	}

	public function setStrInfo($strInfo) {
		$this->strInfo = $strInfo;
	}
}