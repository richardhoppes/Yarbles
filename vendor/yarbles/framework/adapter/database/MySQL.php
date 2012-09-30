<?php
namespace yarbles\framework\adapter\database;

use yarbles\framework\adapter\database\DatabaseAdapterInterface;
use yarbles\framework\exception\database\DatabaseSelectFailedException;
use yarbles\framework\exception\database\DatabaseConnectionFailedException;
use yarbles\framework\exception\database\DatabaseStatementFailedException;
use yarbles\framework\exception\database\DatabaseQueryTypeException;

/**
 * MySQL adapter
 * @author Richard Hoppes
 */
class MySQL implements DatabaseAdapterInterface {

	protected $strDomain;
	protected $strUsername;
	protected $strPassword;
	protected $strDatabaseName;
	protected $dbLink;
	protected $arrResults;

	private static $objDatabaseMySQL;

	public function __construct($strDomain, $strUsername, $strPassword, $strDatabaseName) {
		$this->strDomain = $strDomain;
		$this->strUsername = $strUsername;
		$this->strPassword = $strPassword;
		$this->strDatabaseName = $strDatabaseName;

		$this->dbLink = @mysql_connect($this->strDomain, $this->strUsername, $this->strPassword);
		if(!$this->dbLink)
			throw new DatabaseConnectionFailedException($this->strDomain);

		if(!@mysql_select_db($this->strDatabaseName, $this->dbLink))
			throw new DatabaseSelectFailedException($this->strDatabaseName);
	}

	public function query($strQuery, $arrVariables = array(), $strQueryType = self::QUERY_TYPE_SELECT) {
		$strQuery = $this->prepareQuery($strQuery, $arrVariables);

		$mxdResult = null;

		switch($strQueryType) {
			case self::QUERY_TYPE_SELECT:
				$arrResults = array();
				if($result = mysql_query($strQuery, $this->dbLink)) {
					while($arrRow = mysql_fetch_assoc($result)) {
						$arrResults[] = $arrRow;
					}
				} else {
					throw new DatabaseStatementFailedException($strQuery, mysql_error($this->dbLink));
				}
				$mxdResult = $arrResults;
				break;

			case self::QUERY_TYPE_INSERT:
				$result = mysql_query($strQuery, $this->dbLink);
				if(!$result)
					throw new DatabaseStatementFailedException($strQuery, mysql_error($this->dbLink));
				$mxdResult = $this->getInsertId();
				break;

			case self::QUERY_TYPE_UPDATE:
			case self::QUERY_TYPE_DELETE:
				$result = mysql_query($strQuery, $this->dbLink);
				if(!$result)
					throw new DatabaseStatementFailedException($strQuery, mysql_error($this->dbLink));
				$mxdResult = true;
				break;

			// Unsupported query type
			default:
				throw new DatabaseQueryTypeException($strQueryType);
				break;
		}

		return $mxdResult;
	}

	protected function getInsertId() {
		return mysql_insert_id($this->dbLink);
	}

	protected function prepareQuery($strQuery, $arrVariables) {
		// Find all tokens
		preg_match_all('/val\([A-Za-z0-9\s-_]*\)/i', $strQuery, $arrTokens);
		if(isset($arrTokens[0]) && sizeof($arrTokens[0]) > 0) {

			// Loop all token matches
			foreach($arrTokens[0] as $intIndex => $strToken) {

				// Find actual token variable
				preg_match('/val\(([A-Za-z0-9\s-_]*)\)/i', $strToken, $arrTokenVar);
				if(isset($arrTokenVar[1])) {

					// Perform token replacement
					$strTokenVar = trim($arrTokenVar[1]);

					if(is_string($arrVariables[$strTokenVar]) && $arrVariables[$strTokenVar] == "") {
						$strQuery = str_replace($strToken, "'".$this->prepareValue($arrVariables[$strTokenVar])."'", $strQuery);

					} elseif(is_string($arrVariables[$strTokenVar])) {
						$strQuery = str_replace($strToken, "'".$this->prepareValue($arrVariables[$strTokenVar])."'", $strQuery);

					} elseif (is_numeric($arrVariables[$strTokenVar])){
						$strQuery = str_replace($strToken, $this->prepareValue($arrVariables[$strTokenVar]), $strQuery);

					} elseif (is_null($arrVariables[$strTokenVar])) {
						$strQuery = str_replace($strToken, "NULL", $strQuery);

					}
				}
			}
		}
		return $strQuery;
	}

	public function prepareValue($strValue) {
		return mysql_real_escape_string($strValue, $this->dbLink);
	}

	public function selectForModel($strTable, $strIdField, $mxdIdValue) {
		$arrVariables['id'] = $mxdIdValue;
		$strQuery = "
			SELECT *
			FROM {$strTable}
			WHERE {$strIdField} = val(id)
		";
		return $this->query($strQuery, $arrVariables);
	}

	public function updateForModel($strTable, $arrUpdates, $strIdField, $mxdIdValue) {
		$strSet = "";
		foreach($arrUpdates as $strVariableName => $mxdValue) {
			$strSet .= ($strSet) ? ', ' : '';
			if(is_null($mxdValue))
				$strSet .= " {$strVariableName} = NULL ";
			else
				$strSet .= " {$strVariableName} = '" . $this->prepareValue($mxdValue) . "' ";
		}

		$arrVariables['id'] = $mxdIdValue;
		$strQuery = "
			UPDATE $strTable
			SET {$strSet}
			WHERE {$strIdField} = val(id)
		";

		return $this->query($strQuery, $arrVariables, DatabaseAdapterInterface::QUERY_TYPE_UPDATE);
	}

	public function insertForModel($strTable, $arrUpdates, $strIdField, $mxdIdValue) {
		$strFields = "{$strIdField}";
		$strValues = "'{$mxdIdValue}'";

		foreach($arrUpdates as $strVariableName => $mxdValue) {
			$strFields .= ($strFields) ? ", {$strVariableName}" : "{$strVariableName}";
			if(is_null($mxdValue))
				$strValues .= ($strValues) ? ", NULL" : "";
			else
				$strValues .= ($strValues) ? ", '" . $this->prepareValue($mxdValue) . "'" : "'" . $this->prepareValue($mxdValue) . "'";
		}

		$strQuery = "
			INSERT INTO {$strTable} ({$strFields})
			VALUES ({$strValues})
		";

		return $this->query($strQuery, array(), DatabaseAdapterInterface::QUERY_TYPE_INSERT);
	}


}