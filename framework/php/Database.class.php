<?php
/**
 * Abstract database class
 * TODO: Adapters for different database types (mysql, sql server, etc...)
 * @author Richard Hoppes <rhoppes@gmail.com>
 */
abstract class Database {
	protected $strDomain;
	protected $strUsername;
	protected $strPassword;
	protected $strDatabaseName;
	protected $dbLink;
	protected $arrResults;
}