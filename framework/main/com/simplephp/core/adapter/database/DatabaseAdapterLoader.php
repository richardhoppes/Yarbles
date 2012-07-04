<?
namespace com\simplephp\core\adapter\database;

/**
 * Database adapter loader
 * @author Richard Hoppes
 */
class DatabaseAdapterLoader  {

	private static $objAdapter;

	public static function getHandle($strAdapter, $strServer, $strUsername, $strPassword, $strDatabaseName) {
		if(!self::$objAdapter) {
			self::$objAdapter = $strAdapter::getHandle($strServer, $strUsername, $strPassword, $strDatabaseName);
		}
		return self::$objAdapter;
	}

}