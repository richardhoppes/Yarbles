<?php
namespace yarbles\framework\exception\request;

use yarbles\framework\exception\request\BaseRequestException;

class BadRequestException extends BaseRequestException {

	public function __construct($strMessage = "Bad Request", $intExceptionCode = null) {
		parent::__construct($strMessage, $intExceptionCode);
	}

}