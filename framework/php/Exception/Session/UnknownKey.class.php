<?php

class Exception_Session_UnknownKey extends Exception_Session {
	protected $strKey;

	public function __construct($strKey = null) {
		$strKey ? $this->strKey = $strKey : null;
		parent::__construct('Unknown Session Key');
	}

	public function getKey() {
		return $this->strKey;
	}
}