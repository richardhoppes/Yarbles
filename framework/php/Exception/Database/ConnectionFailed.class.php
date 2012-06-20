<?php
/**
 * Database connection exception
 * @author Richard Hoppes <rhoppes@gmail.com>
 */
class Exception_Database_ConnectionFailed extends Exception_Database {
	protected $strHost;

	public function __construct($strHost) {
		$this->strHost = $strHost;
		parent::__construct("Database connection failed");
	}

	public function getStrHost() {
		return $this->strHost;
	}

	public function setStrHost($strHost) {
		$this->strHost = $strHost;
	}
}