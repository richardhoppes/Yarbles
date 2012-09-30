<?
namespace yarbles\framework\common;

use yarbles\framework\Config;
use yarbles\framework\adapter\database\DatabaseAdapterLoader;
use yarbles\framework\FrontController;
use yarbles\framework\RequestHandler;
use yarbles\framework\service\RestService;
use yarbles\framework\adapter\http\client\Curl;
use yarbles\framework\api\tmdb\TmdbSearch;
use yarbles\framework\adapter\cache\Memcached;
use yarbles\framework\adapter\database\DatabaseAdapterInterface;
use yarbles\framework\Session;

/**
 * Service locator
 * You should always use this to instantiate instances of framework classes.  Loose coupling is our friend.
 * @author Richard Hoppes
 */
class YarblesLocator {

	protected static $arrDatabaseAdapters = array();

	public static function getConfig() {
		return Config::getHandle();
	}

	public static function getFrontController() {
		return new FrontController();
	}

	public static function getRequestHandler($mxdValidRequestMethods = array()) {
		return new RequestHandler($mxdValidRequestMethods);
	}

	public static function getCurlHttpClientAdapter() {
		return new Curl();
	}

	public static function getRestService($strHost, $intPort = 80) {
		return new RestService(self::getCurlHttpClientAdapter(), $strHost, $intPort);
	}

	public static function getDatabaseAdapter($strAdapter, $strServer, $strUsername, $strPassword, $strDatabaseName) {
		$strKey = md5($strAdapter.$strServer.$strDatabaseName);
		if(!self::$arrDatabaseAdapters[$strKey]) {
			$strAdapterClass = self::getConfig()->getProperty("database_adapter_namespace") . "\\" . $strAdapter;
			self::$arrDatabaseAdapters[$strKey] = new $strAdapterClass($strDomain, $strUsername, $strPassword, $strDatabaseName);
		}
		return self::$arrDatabaseAdapters[$strKey];
	}

	public static function getTmdbApiSearch() {
		return new TmdbSearch();
	}

	public static function getSession() {
		return Session::getHandle();
	}

}