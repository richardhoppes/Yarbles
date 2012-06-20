<?php
/**
 * View not found exception
 * @author Richard Hoppes <rhoppes@gmail.com>
 */
class Exception_View_ViewNotFound extends Exception_View {
	protected $strInfo;

	public function __construct($strInfo = null) {
		$strInfo ? $this->strInfo = $strInfo : null;
		parent::__construct('View Not Found');
	}

	public function getStrInfo() {
		return $this->strInfo;
	}

	public function setStrInfo($strInfo) {
		$this->strInfo = $strInfo;
	}
}