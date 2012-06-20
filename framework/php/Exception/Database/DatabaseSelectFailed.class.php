<?php
/**
 * Database connection exception
 * @author Richard Hoppes <rhoppes@gmail.com>
 */
class Exception_Database_DatabaseSelectFailed extends Exception_Database {
	protected $strDatabaseName;

	public function __construct($strDatabaseName) {
		$this->strDatabaseName = $strDatabaseName;
		parent::__construct("Database select failed");
	}

	public function getStrDatabaseName() {
		return $this->strDatabaseName;
	}

	public function setStrDatabaseName($strDatabaseName) {
		$this->strDatabaseName = $strDatabaseName;
	}
}