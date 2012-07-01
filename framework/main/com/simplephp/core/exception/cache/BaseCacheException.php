<?php
namespace com\simplephp\core\exception\cache;

use com\simplephp\core\exception\GeneralException;

class BaseCacheException extends GeneralException {
	public function __construct($strMessage) {
		parent::__construct($strMessage);
	}
}