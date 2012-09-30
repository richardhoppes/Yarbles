<?php
namespace yarbles\framework\exception\controller;

use yarbles\framework\exception\GeneralException;

class BaseControllerException extends GeneralException {

	public function __construct($strMessage) {
		parent::__construct($strMessage);
	}
	
}