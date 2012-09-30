<?php
namespace yarbles\framework\adapter\cache;

use yarbles\framework\exception\cache\CacheNotConnectedException;
use yarbles\framework\exception\cache\UnableToFlushCacheException;
use yarbles\framework\exception\cache\UnableToRetrieveCacheStatsException;
use \yarbles\framework\ConfigInterface;

/**
 * Memcache adapter
 *
 * Requires memcached to be running
 * Example start command: memcached -m 8 -l 127.0.0.1 -p 11211 -d
 *
 * @author Richard Hoppes
 */
class Memcached implements CacheAdapterInterface {

	public function getItem($strKey) {
		throw new \Exception("Not yet implemented");
	}

	public function setItem($strKey, $mxdValue) {
		throw new \Exception("Not yet implemented");
	}

	public function deleteItem($strKey) {
		throw new \Exception("Not yet implemented");
	}

	public function flush() {
		throw new \Exception("Not yet implemented");
	}

	public function getTotalSpace() {
		throw new \Exception("Not yet implemented");
	}

	public function getAvailableSpace() {
		throw new \Exception("Not yet implemented");
	}

	public function clearExpired() {
		throw new \Exception("Not yet implemented");
	}
}