<?
namespace com\simplephp\core\adapter\database;

use com\simplephp\core\adapter\database\DatabaseAdapterInterface;

/**
 * Mysqli adapter
 * @author Richard Hoppes
 */
class MySqlImproved implements DatabaseAdapterInterface {

	public function query($strQuery, $arrVariables = array(), $strQueryType = self::QUERY_TYPE_SELECT) {
		// TODO: Implement query() method.
	}

	public function prepareValue($strValue) {
		// TODO: Implement prepareValue() method.
	}
}