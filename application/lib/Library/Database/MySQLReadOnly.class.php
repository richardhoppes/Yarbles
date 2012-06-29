<?
class Library_Database_MySQLReadOnly extends Adapter_Database_Loader implements Adapter_Interface {

	public static function getHandle() {
		$objConfig = Config::getHandle();
		return parent::getHandle(
			$objConfig->MYSQL_READONLY_DATABASE_ADAPTER,
			$objConfig->MYSQL_READONLY_DATABASE_SERVER,
			$objConfig->MYSQL_READONLY_DATABASE_USERNAME,
			$objConfig->MYSQL_READONLY_DATABASE_PASSWORD,
			$objConfig->MYSQL_READONLY_DATABASE_NAME
		);
	}

}