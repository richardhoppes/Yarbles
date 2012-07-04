<?php
namespace com\simplephp\core\exception\request;

use com\simplephp\core\exception\GeneralException;

class BaseRequestException extends GeneralException {
	public function __construct($strMessage) {
		parent::__construct($strMessage);
	}
}