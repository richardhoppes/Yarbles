<?php
namespace yarbles\framework\exception\request;

use yarbles\framework\exception\request\BaseRequestException;

class RequestMethodNotAllowedException extends BaseRequestException {
	protected $strRequestMethod;

	public function __construct($strRequestMethod, $intExceptionCode = null) {
		$this->strRequestMethod = $strRequestMethod;
		parent::__construct("Invalid Request", $intExceptionCode);
	}

	public function getRequestMethod() {
		return $this->strRequestMethod;
	}
}