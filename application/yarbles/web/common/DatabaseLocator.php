<?
namespace yarbles\web\common;

use yarbles\framework\Config;
use yarbles\framework\adapter\database\DatabaseAdapterLoader;
use yarbles\framework\common\YarblesLocator;

class DatabaseLocator {
	
	public static function getReadWriteDatabase() {
		return YarblesLocator::getDatabaseAdapter(
			YarblesLocator::getConfig()->getProperty("readwrite_database_adapter"),
			YarblesLocator::getConfig()->getProperty("readwrite_database_server"),
			YarblesLocator::getConfig()->getProperty("readwrite_database_username"),
			YarblesLocator::getConfig()->getProperty("readwrite_database_password"),
			YarblesLocator::getConfig()->getProperty("readwrite_database_name")
		);
	}

}