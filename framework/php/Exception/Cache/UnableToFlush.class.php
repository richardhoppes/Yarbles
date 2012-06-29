<?php

class Exception_Cache_UnableToFlush extends Exception_Cache {

	protected $strErrorCode;

	public function __construct($strErrorCode) {
		$this->strErrorCode = $strErrorCode;
		parent::__construct('Unable to flush cache');
	}

	public function getErrorCode() {
		return $this->strErrorCode;
	}
}