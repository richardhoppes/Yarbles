<?php

abstract class Model {
	protected $strTable;
	protected $mxdId;
	protected $strIdField;

	public function __construct($strTable, $mxdId = null, $strIdField = 'intId') {
		$this->strTable = $strTable;
		$this->mxdId = $mxdId;
		$this->strIdField = $strIdField;
	}

	public function load($strQuery = null, $arrVariables = array()) {
		$objDatabase = Database_MySQL::getHandle();

		// If no query was supplied, load record by id
		if(!$strQuery) {
			$arrVariables['id'] = $this->mxdId;
			$strQuery = "
				SELECT *
				FROM {$this->strTable}
				WHERE {$this->strIdField} = val(id)
			";
		}

		// Execute query
		$arrResult = $objDatabase->query($strQuery, $arrVariables);

		// Set field values, or reset if no record was found
		if(isset($arrResult[0]) && is_array($arrResult[0]) && sizeof($arrResult) > 0) {
			foreach($arrResult[0] as $strFieldName => $mxdValue) {
				if($strFieldName == $this->strIdField)
					$this->mxdId = $mxdValue;
				else
					$this->$strFieldName = $mxdValue;
			}
		} else {
			$this->reset();
		}
	}

	public function save() {
		$objDatabase = Database_MySQL::getHandle();

		// Perform update
		if($this->mxdId) {
			$strSet = "";
			foreach($this->getChildClassVariables() as $intIndex => $strVariableName) {
				$strSet .= ($strSet) ? ', ' : '';
				if(is_null($this->$strVariableName))
					$strSet .= " {$strVariableName} = NULL ";
				else
					$strSet .= " {$strVariableName} = '".$objDatabase->prepareValue($this->$strVariableName)."' ";
			}

			$strQuery = "
				UPDATE $this->strTable
				SET {$strSet}
				WHERE {$this->strIdField} = '{$this->mxdId}'
			";

			$objDatabase->query($strQuery, array(), Database_MySQL::QUERY_TYPE_UPDATE);
		}

		// Perform insert
		else {
			$strFields = "{$this->strIdField}";
			$strValues = "'{$this->mxdId}'";

			foreach($this->getChildClassVariables() as $intIndex => $strVariableName) {
				// Fields
				$strFields .= ($strFields) ? ", {$strVariableName}" : "{$strVariableName}";

				// Values
				if(is_null($this->$strVariableName))
					$strValues .= ($strValues) ? ", NULL" : "";
				else
					$strValues .= ($strValues) ? ", '".$objDatabase->prepareValue($this->$strVariableName)."'" : "'".$objDatabase->prepareValue($this->$strVariableName)."'";
			}

			$strQuery = "
				INSERT INTO $this->strTable ({$strFields})
				VALUES ({$strValues})
			";

			$this->mxdId = $objDatabase->query($strQuery, array(), Database_MySQL::QUERY_TYPE_INSERT);
		}
	}

	public function getId() {
		return $this->mxdId;
	}

	public function setId($mxdId) {
		$this->mxdId = $mxdId;
	}

	protected function getChildClassVariables() {
		$objReflection = new ReflectionClass($this);
		$arrVars = array_keys($objReflection->getdefaultProperties());

		$objReflection = new ReflectionClass(__CLASS__);
		$arrParentVars = array_keys($objReflection->getdefaultProperties());

		$arrChildVars = array();
		foreach ($arrVars as $strKey) {
			if (!in_array($strKey, $arrParentVars)) {
				$arrChildVars[] = $strKey;
			}
		}
		return $arrChildVars;
	}

	protected function reset() {
		$arrClassVariables = $this->getChildClassVariables();

		if(sizeof($arrClassVariables) > 0) {
			foreach($arrClassVariables as $strVariableName) {
				$this->$strVariableName = null;
			}
		}
	}

}