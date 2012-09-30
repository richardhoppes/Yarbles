<?php
namespace yarbles\framework\exception\database;

use yarbles\framework\exception\database\BaseDatabaseException;

class DatabaseConnectionFailedException extends BaseDatabaseException {
	protected $strHost;

	public function __construct($strHost) {
		$this->strHost = $strHost;
		parent::__construct("Database connection failed");
	}

	public function getHost() {
		return $this->strHost;
	}
}