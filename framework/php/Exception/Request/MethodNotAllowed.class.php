<?php

class Exception_Request_MethodNotAllowed extends Exception_Request {
	protected $strRequestMethod;

	public function __construct($strRequestMethod) {
		$this->strRequestMethod = $strRequestMethod;
		parent::__construct('Invalid Request');
	}

	public function getRequestMethod() {
		return $this->strRequestMethod;
	}
}