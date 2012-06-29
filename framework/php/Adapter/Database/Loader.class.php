<?
/**
 * Database adapter loader
 * @author Richard Hoppes
 */
class Adapter_Database_Loader {

	private static $objAdapter;

	public static function getHandle($strAdapter, $strServer, $strUsername, $strPassword, $strDatabaseName) {
		if(!self::$objAdapter) {
			$strAdapterName = "Adapter_Database_" . $strAdapter;
			self::$objAdapter = $strAdapterName::getHandle($strServer, $strUsername, $strPassword, $strDatabaseName);
		}
		return self::$objAdapter;
	}

}