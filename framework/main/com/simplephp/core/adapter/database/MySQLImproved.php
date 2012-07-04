<?
namespace com\simplephp\core\adapter\database;

use com\simplephp\core\adapter\database\DatabaseAdapterInterface;

/**
 * Mysqli adapter
 * @author Richard Hoppes
 */
class MySqlImproved implements DatabaseAdapterInterface {

	public function query($strQuery, $arrVariables = array(), $strQueryType = self::QUERY_TYPE_SELECT) {
		return null; // TODO: Implement query() method.
	}

	public function prepareValue($strValue) {
		return null; // TODO: Implement prepareValue() method.
	}

	public function selectForModel($strTable, $strIdField, $mxdIdValue) {
		return null; // TODO: Implement selectForModel() method.
	}

	public function updateForModel($strTable, $arrUpdates, $strIdField, $mxdIdValue) {
		return null; // TODO: Implement updateForModel() method.
	}

	public function insertForModel($strTable, $arrUpdates, $strIdField, $mxdIdValue) {
		return null; // TODO: Implement insertForModel() method.
	}
}