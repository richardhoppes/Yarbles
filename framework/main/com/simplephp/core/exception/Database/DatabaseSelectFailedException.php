<?php
namespace com\simplephp\core\exception\database;

use com\simplephp\core\exception\database\BaseDatabaseException;

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