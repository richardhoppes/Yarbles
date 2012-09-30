<?php
namespace yarbles\framework\exception\http;

use yarbles\framework\exception\http\BaseHttpException;

class UnsupportedRequestTypeException extends BaseHttpException {

	protected $strRequestType;

	public function __construct($strRequestType) {
		$this->strRequestType = $strRequestType;
		parent::__construct("Unsupported request type: {$strRequestType}");
	}

	public function getRequestType() {
		return $strRequestType;
	}

}