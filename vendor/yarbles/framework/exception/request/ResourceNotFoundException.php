<?php
namespace yarbles\framework\exception\request;

use yarbles\framework\exception\request\BaseRequestException;

class ResourceNotFoundException extends BaseRequestException {

	public function __construct($strMessage = "Resource Not Found", $intExceptionCode = null) {
		parent::__construct($strMessage, $intExceptionCode);
	}

}