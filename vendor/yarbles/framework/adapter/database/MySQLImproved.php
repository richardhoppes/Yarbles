<?
namespace yarbles\framework\adapter\database;

use yarbles\framework\adapter\database\DatabaseAdapterInterface;

/**
 * Mysqli adapter
 * @author Richard Hoppes
 */
class MySqlImproved implements DatabaseAdapterInterface {

	public function query($strQuery, $arrVariables = array(), $strQueryType = self::QUERY_TYPE_SELECT) {
		throw new \Exception("Not yet implemented"); 
	}

	public function prepareValue($strValue) {
		throw new \Exception("Not yet implemented"); 
	}

	public function selectForModel($strTable, $strIdField, $mxdIdValue) {
		throw new \Exception("Not yet implemented"); 
	}

	public function updateForModel($strTable, $arrUpdates, $strIdField, $mxdIdValue) {
		throw new \Exception("Not yet implemented"); 
	}

	public function insertForModel($strTable, $arrUpdates, $strIdField, $mxdIdValue) {
		throw new \Exception("Not yet implemented"); 
	}
}