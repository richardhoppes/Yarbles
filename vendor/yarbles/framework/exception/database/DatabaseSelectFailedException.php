<?php
namespace yarbles\framework\exception\database;

use yarbles\framework\exception\database\BaseDatabaseException;

class DatabaseSelectFailedException extends BaseDatabaseException {
	protected $strDatabaseName;

	public function __construct($strDatabaseName) {
		$this->strDatabaseName = $strDatabaseName;
		parent::__construct("Database select failed");
	}

	public function getDatabaseName() {
		return $this->strDatabaseName;
	}
}