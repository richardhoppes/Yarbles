<?php
namespace yarbles\framework\exception\view;

use yarbles\framework\exception\GeneralException;

class BaseViewException extends GeneralException {

	public function __construct($strMessage) {
		parent::__construct($strMessage);
	}
	
}