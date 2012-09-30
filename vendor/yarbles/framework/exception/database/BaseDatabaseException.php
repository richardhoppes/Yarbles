<?php
namespace yarbles\framework\exception\database;

use yarbles\framework\exception\GeneralException;

class BaseDatabaseException extends GeneralException {

	public function __construct($strMessage) {
		parent::__construct($strMessage);
	}
	
}