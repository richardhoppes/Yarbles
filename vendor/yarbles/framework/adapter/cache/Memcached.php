<?php
namespace yarbles\framework\adapter\cache;

use yarbles\framework\exception\cache\CacheNotConnectedException;

/**
 * Memcache adapter
 *
 * Requires memcached to be running
 * Example start command: memcached -m 8 -l 127.0.0.1 -p 11211 -d
 *
 * @author Richard Hoppes
 */
class Memcached implements CacheAdapterInterface {
	private $strServer;
	private $intPort;
	private $boolConnected = false;
	private $objMemcache;

	public function __construct($strServer, $intPort) {
		$this->strServer = $strServer;
		$this->intPort = $intPort;

		$this->objMemcache = new \Memcache;
		$this->boolConnected = @$this->objMemcache->connect($strServer, $intPort);

		if(!$this->boolConnected) {
			throw new CacheNotConnectedException($strServer, $intPort);
		}
	}

	protected function getKey() {
		return $this->strServer . ":" . $this->intPort;
	}

	public function getItem($strKey) {
		return $this->objMemcache->get($strKey);
	}

	public function setItem($strKey, $mxdValue) {
		return $this->objMemcache->set($strKey, $mxdValue);
	}

	public function deleteItem($strKey) {
		return $this->objMemcache->delete($strKey);
	}

	public function flush() {
		$this->objMemcache->flush();
	}

	public function getTotalBytes() {
		$arrExtendedStats = $this->objMemcache->getextendedstats();
		return $arrExtendedStats[$this->getKey()]['limit_maxbytes'];
	}

	public function getAvailableBytes() {
		$arrExtendedStats = $this->objMemcache->getextendedstats();
		$intMaxBytes = $arrExtendedStats[$this->getKey()]['limit_maxbytes'];
		$intBytesWritten = $arrExtendedStats[$this->getKey()]['bytes_written'];

		return $intMaxBytes - $intBytesWritten;
	}

	public function dumpStats() {
		$arrStats = $this->objMemcache->getextendedstats();
		return $arrStats[$this->getKey()];
	}
}