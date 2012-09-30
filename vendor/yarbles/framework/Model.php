<?php
namespace yarbles\framework;

use yarbles\framework\adapter\database\DatabaseAdapterInterface;
use yarbles\framework\ModelInterface;

/**
 * Abstract model class
 * @author Richard Hoppes
 */
abstract class Model implements ModelInterface {
	protected $strTable;
	protected $mxdId;
	protected $strIdField;
	protected $objDatabase;

	public function __construct(DatabaseAdapterInterface $objDatabase, $strTable, $mxdId = null, $strIdField = 'intId') {
		$this->objDatabase = $objDatabase;
		$this->strTable = $strTable;
		$this->mxdId = $mxdId;
		$this->strIdField = $strIdField;
	}

	public function load($strQuery = null, $arrVariables = array()) {
		$arrResult = array();

		// If a query WAS supplied, run it
		// Otherwise, load record by id
		if($strQuery) {
			$arrResult = $this->objDatabase->query($strQuery, $arrVariables);
		} else {
			$arrResult = $this->objDatabase->selectForModel($this->strTable, $this->strIdField, $this->mxdId);
		}

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

	public function initFromArray($arrIn) {
		foreach($arrIn as $strField => $mxdValue) {
			$strMethod = $strField;
			if(
				substr($strField, 0, 3) == "str" || 
				substr($strField, 0, 3) == "int" || 
				substr($strField, 0, 3) == "dbl") {
				$strMethod = substr_replace($strField, "", 0, 3);
			} elseif (
				substr($strField, 0, 4) == "date" || 
				substr($strField, 0, 4) == "bool"){
				$strMethod = substr_replace($strField, "", 0, 4);
			} 
			
			$strMethod = "set" . ucfirst($strMethod);

			if(!method_exists(get_class($this), $strMethod)) {
				throw new \Exception("Method {$strMethod} does not exist in class " . get_class($this));
			}

			$this->$strMethod($mxdValue);
		}
	}

	public function save() {
		$arrUpdates = array();
		foreach($this->getChildClassVariables() as $intIndex => $strVariableName) {
			$arrUpdates[$strVariableName] = $this->$strVariableName;
		}		

		// Perform update
		if($this->mxdId) {
			$this->objDatabase->updateForModel($this->strTable, $arrUpdates, $this->strIdField, $this->mxdId);
		}
		// Perform insert
		else {
			$this->mxdId = $this->objDatabase->insertForModel($this->strTable, $arrUpdates, $this->strIdField, $this->mxdId);
		}
	}

	public function getId() {
		return $this->mxdId;
	}

	public function setId($mxdId) {
		$this->mxdId = $mxdId;
	}

	protected function getChildClassVariables() {
		$objReflection = new \ReflectionClass($this);
		$arrVars = array_keys($objReflection->getdefaultProperties());

		$objReflection = new \ReflectionClass(__CLASS__);
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

		$this->mxdId = null;
	}

}