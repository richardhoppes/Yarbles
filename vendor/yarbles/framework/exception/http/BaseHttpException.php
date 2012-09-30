<?php
namespace yarbles\framework\exception\http;

use yarbles\framework\exception\GeneralException;

class BaseHttpException extends GeneralException {

	public function __construct($strMessage, $intErrorCode = 30000) {
		parent::__construct($strMessage);
	}
	
}