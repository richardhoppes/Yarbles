<?php
namespace com\simplephp\core\adapter\cache;

use com\simplephp\core\exception\cache\CacheNotConnectedException;
use com\simplephp\core\exception\cache\UnableToFlushCacheException;
use com\simplephp\core\exception\cache\UnableToRetrieveCacheStatsException;

/**
 * Memcache adapter
 *
 * Requires memcached to be running
 * Example start command: memcached -m 8 -l 127.0.0.1 -p 11211 -d
 *
 * @author Richard Hoppes
 */
class Adapter_Cache_Memcached implements Adapter_Cache_Interface {

	private static $objCache;

	private $objMemcache;

	private $boolConnected = false;

	private function __construct() {
		$objConfig = Config::getHandle();

		$this->objMemcache = new Memcache;
		$this->boolConnected = @$this->objMemcache->connect($objConfig->CACHE_SERVER, $objConfig->CACHE_PORT);

		if(!$this->boolConnected) {
			throw new CacheNotConnectedException($objConfig->CACHE_SERVER, $objConfig->CACHE_PORT);
		}
	}

	public static function getHandle() {
		if(!self::$objCache) {
			self::$objCache = new self();
		}
		return self::$objCache;
	}

	public function setItem($strKey, $mxdValue) {
		return $this->objMemcache->set($strKey, $mxdValue);
	}

	public function getItem($strKey) {
		return $this->objMemcache->get($strKey);
	}

	public function deleteItem($strKey) {
		$this->objMemcache->delete($strKey);
	}

	public function flush() {
		if (!$this->objMemcache->flush()) {
			throw new UnableToFlushCacheException("Memcache error: " . $this->objMemcache->getResultCode());
		}
		return true;
	}

	public function getTotalSpace() {
		$arrStats = $this->objMemcache->getStats();
		if ($arrStats === false) {
			throw new UnableToRetrieveCacheStatsException($this->memcached->getResultMessage());
		}
		$arrMem = array_pop($arrStats);
		return $arrMem['limit_maxbytes'];
	}

	public function getAvailableSpace() {
		$arrStats = $this->objMemcache->getStats();
		if ($arrStats === false) {
			throw new UnableToRetrieveCacheStatsException($this->memcached->getResultMessage());
		}
		$arrMem = array_pop($arrStats);
		return $arrMem['limit_maxbytes'] - $arrMem['bytes'];
	}

	public function clearExpired() {
		// TODO: Implement clearExpired() method.
	}
}