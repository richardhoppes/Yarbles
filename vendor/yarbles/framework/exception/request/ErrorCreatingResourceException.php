<?php
namespace yarbles\framework\exception\request;

use yarbles\framework\exception\request\BaseRequestException;

class ErrorCreatingResourceException extends BaseRequestException {

	public function __construct($strMessage = "Error Creating Resource", $intExceptionCode = null) {
		parent::__construct($strMessage, $intExceptionCode);
	}

}