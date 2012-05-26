<?php
/**
 * Database update exception
 * @author Richard Hoppes <rhoppes@gmail.com>
 */
class Exception_Database_StatementFailed extends Exception_Database {
	protected $strQueryType;

	public function __construct($strQueryType) {
		$strQueryType ? $this->strQueryType =  $strQueryType : null;
		parent::__construct("Unsupported Query Type ({$strQueryType})");
	}

	public function getStrQueryType() {
		return $this->strQueryType;
	}

	public function setStrQueryType($strQueryType) {
		$this->strQueryType = $strQueryType;
	}
}