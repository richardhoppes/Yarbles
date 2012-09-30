<?php
namespace yarbles\framework\exception\request;

use yarbles\framework\exception\request\BaseRequestException;

class ErrorUpdatingResourceException extends BaseRequestException {

	public function __construct($strMessage = "Error Updating Resource", $intExceptionCode = null) {
		parent::__construct($strMessage, $intExceptionCode);
	}

}