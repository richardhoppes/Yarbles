<?
class Library_Database_MySQLReadWrite extends Adapter_Database_Loader implements Adapter_Interface {

	public static function getHandle() {
		$objConfig = Config::getHandle();
		return parent::getHandle(
			$objConfig->MYSQL_READWRITE_DATABASE_ADAPTER,
			$objConfig->MYSQL_READWRITE_DATABASE_SERVER,
			$objConfig->MYSQL_READWRITE_DATABASE_USERNAME,
			$objConfig->MYSQL_READWRITE_DATABASE_PASSWORD,
			$objConfig->MYSQL_READWRITE_DATABASE_NAME
		);
	}

}