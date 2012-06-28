<?php

class Exception_Database_ConnectionFailed extends Exception_Database {
	protected $strHost;

	public function __construct($strHost) {
		$this->strHost = $strHost;
		parent::__construct("Database connection failed");
	}

	public function getHost() {
		return $this->strHost;
	}
}