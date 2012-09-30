<?php
namespace yarbles\framework\exception\cache;

use yarbles\framework\exception\GeneralException;

class BaseCacheException extends GeneralException {

	public function __construct($strMessage) {
		parent::__construct($strMessage);
	}
	
}