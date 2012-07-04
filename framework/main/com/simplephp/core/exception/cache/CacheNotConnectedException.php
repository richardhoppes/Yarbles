<?php
namespace com\simplephp\core\exception\cache;

use com\simplephp\core\exception\cache\BaseCacheException;

class CacheNotConnectedException extends BaseCacheException {

	protected $strServer;

	protected $strPort;

	public function __construct($strServer, $strPort) {
		$this->strServer = $strServer;
		$this->strPort = $strPort;
		parent::__construct('Not connected to cache server');
	}

	public function getServer()
	{
		return $this->strServer;
	}

	public function getPort()
	{
		return $this->strPort;
	}

}