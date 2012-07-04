<?php
namespace com\simplephp\core\exception\database;

use com\simplephp\core\exception\database\BaseDatabaseException;

class DatabaseQueryTypeException extends BaseDatabaseException {
	protected $strQueryType;

	public function __construct($strQueryType) {
		$strQueryType ? $this->strQueryType =  $strQueryType : null;
		parent::__construct("Unsupported Query Type ({$strQueryType})");
	}

	public function getQueryType() {
		return $this->strQueryType;
	}

}