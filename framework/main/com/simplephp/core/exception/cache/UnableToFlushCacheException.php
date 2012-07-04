<?php
namespace com\simplephp\core\exception\cache;

use com\simplephp\core\exception\cache\BaseCacheException;

class UnableToFlushCacheException extends BaseCacheException {

	protected $strErrorCode;

	public function __construct($strErrorCode) {
		$this->strErrorCode = $strErrorCode;
		parent::__construct('Unable to flush cache');
	}

	public function getErrorCode() {
		return $this->strErrorCode;
	}
}