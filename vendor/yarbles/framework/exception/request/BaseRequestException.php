<?php
namespace yarbles\framework\exception\request;

use yarbles\framework\exception\GeneralException;

class BaseRequestException extends GeneralException {

	public function __construct($strMessage, $intExceptionCode = null) {
		parent::__construct($strMessage, $intExceptionCode);
	}

}