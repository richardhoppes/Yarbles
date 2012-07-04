<?php
namespace com\simplephp\core\exception\database;

use com\simplephp\core\exception\GeneralException;

class BaseDatabaseException extends GeneralException {
	public function __construct($strMessage) {
		parent::__construct($strMessage);
	}
}