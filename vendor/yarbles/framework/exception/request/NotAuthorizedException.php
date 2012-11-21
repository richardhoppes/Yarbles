<?php
namespace yarbles\framework\exception\request;

use yarbles\framework\exception\request\BaseRequestException;

class NotAuthorizedException extends BaseRequestException {

	public function __construct($strMessage = "Not Authorized", $intExceptionCode = null) {
		parent::__construct($strMessage, $intExceptionCode);
	}

}