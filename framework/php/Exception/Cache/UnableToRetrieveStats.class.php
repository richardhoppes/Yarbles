<?php

class Exception_Cache_UnableToRetrieveStats extends Exception_Cache {

	protected $strStatusMessage;

	public function __construct($strStatusMessage) {
		$this->strStatusMessage = $strStatusMessage;
		parent::__construct('Unable to retrieve stats');
	}

	public function getErrorMessage() {
		return $this->strStatusMessage;
	}
}