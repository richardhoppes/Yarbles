<?php
/**
 * Database update exception
 * @author Richard Hoppes <rhoppes@gmail.com>
 */
class Exception_Database_StatementFailed extends Exception_Database {
	protected $strQuery;
	protected $strError;
	protected $strQueryType;

	public function __construct($strQuery = null, $strQueryType = null, $strError = null) {
		$strQuery ? $this->strQuery = $strQuery : null;
		$strError ? $this->strError = $strError : null;
		$strQueryType ? $this->strQueryType =  $strQueryType : null;
		parent::__construct("Statement Failed");
	}

	public function getStrQueryType() {
		return $this->strQueryType;
	}

	public function setStrQueryType($strQueryType) {
		$this->strQueryType = $strQueryType;
	}

	public function getStrError() {
		return $this->strError;
	}

	public function setStrError($strError) {
		$this->strError = $strError;
	}

	public function getStrQuery() {
		return $this->strQuery;
	}

	public function setStrQuery($strQuery) {
		$this->strQuery = $strQuery;
	}
}