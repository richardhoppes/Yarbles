<?php
namespace com\simplephp\core\exception\controller;

use com\simplephp\core\exception\GeneralException;

class BaseControllerException extends GeneralException {
	public function __construct($strMessage) {
		parent::__construct($strMessage);
	}
}