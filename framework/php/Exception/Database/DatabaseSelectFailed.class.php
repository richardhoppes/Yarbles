<?php

class Exception_Database_DatabaseSelectFailed extends Exception_Database {
	protected $strDatabaseName;

	public function __construct($strDatabaseName) {
		$this->strDatabaseName = $strDatabaseName;
		parent::__construct("Database select failed");
	}

	public function getDatabaseName() {
		return $this->strDatabaseName;
	}
}