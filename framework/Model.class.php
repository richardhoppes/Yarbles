<?php
/**
 * Base model class
 * TODO: Remove dependency on Database_MySQL, use adapters for different database types (mysql, sql server, etc...)
 * @author Richard Hoppes <rhoppes@gmail.com>
 */
class Model {
	protected $strTable;
	protected $mxdId;
	protected $strIdField;

	/**
	 * Constructor
	 * @param string $strTable
	 * @param int $mxdId
	 * @param string $strIdField
	 */
	public function __construct($strTable, $mxdId = null, $strIdField = 'intId') {
		$this->strTable = $strTable;
		$this->mxdId = $mxdId;
		$this->strIdField = $strIdField;
	}

	/**
	 * Load record
	 * @param null $strQuery
	 * @param array $arrVariables
	 * @return void
	 */
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

	/**
	 * Save changes
	 * 1. Uses reflection to get all class variables, minus variables in the base class
	 * 2. Assigns each variable the value it currently has in the object
	 * @return void
	 */
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

	/**
	 * Get id
	 * @return int|null
	 */
	public function getId() {
		return $this->mxdId;
	}

	/**
	 * Set id
	 * @param $mxdId
	 * @return void
	 */
	public function setId($mxdId) {
		$this->mxdId = $mxdId;
	}

	/**
	 * Use reflection to get variables from child class
	 * @return array
	 */
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

	/**
	 * Reset model
	 * @return void
	 */
	protected function reset() {
		$arrClassVariables = $this->getChildClassVariables();
		
		if(sizeof($arrClassVariables) > 0) {
			foreach($arrClassVariables as $strVariableName) {
				$this->$strVariableName = null;
			}
		}
	}

}