<?php
namespace yarbles\framework\exception\cache;

use yarbles\framework\exception\cache\BaseCacheException;

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