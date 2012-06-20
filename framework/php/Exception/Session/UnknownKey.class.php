<?php
/**
 * Unknown session key exception
 * @author Richard Hoppes <rhoppes@gmail.com>
 */
class Exception_Session_UnknownKey extends Exception_Session {
	protected $strInfo;

	public function __construct($strInfo = null) {
		$strInfo ? $this->strInfo = $strInfo : null;
		parent::__construct('Unknown Session Key');
	}

	public function getStrInfo() {
		return $this->strInfo;
	}

	public function setStrInfo($strInfo) {
		$this->strInfo = $strInfo;
	}
}