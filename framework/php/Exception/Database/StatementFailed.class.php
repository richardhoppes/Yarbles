<?php

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

	public function getQueryType() {
		return $this->strQueryType;
	}

	public function getError() {
		return $this->strError;
	}

	public function getQuery() {
		return $this->strQuery;
	}

}