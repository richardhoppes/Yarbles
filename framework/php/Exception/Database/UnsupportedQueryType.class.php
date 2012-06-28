<?php

class Exception_Database_StatementFailed extends Exception_Database {
	protected $strQueryType;

	public function __construct($strQueryType) {
		$strQueryType ? $this->strQueryType =  $strQueryType : null;
		parent::__construct("Unsupported Query Type ({$strQueryType})");
	}

	public function getQueryType() {
		return $this->strQueryType;
	}

}