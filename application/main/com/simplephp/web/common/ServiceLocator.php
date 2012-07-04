<?
namespace com\simplephp\web\common;

use com\simplephp\core\Config;
use com\simplephp\core\adapter\database\DatabaseAdapterLoader;

class ServiceLocator implements ServiceLocatorInterface {
	
	public static function getConfig() {
		return Config::getHandle();
	}

	public static function getReadWriteDatabase() {
		return DatabaseAdapterLoader::getHandle(
			self::getConfig()->getProperty("readwrite_database_adapter"),
			self::getConfig()->getProperty("readwrite_database_server"),
			self::getConfig()->getProperty("readwrite_database_username"),
			self::getConfig()->getProperty("readwrite_database_password"),
			self::getConfig()->getProperty("readwrite_database_name")
		);
	}

}