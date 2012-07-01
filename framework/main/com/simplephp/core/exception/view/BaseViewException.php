<?php
namespace com\simplephp\core\exception\view;

use com\simplephp\core\exception\GeneralException;

class BaseViewException extends GeneralException {
	public function __construct($strMessage) {
		parent::__construct($strMessage);
	}
}