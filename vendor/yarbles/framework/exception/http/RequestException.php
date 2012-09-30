<?php
namespace yarbles\framework\exception\http;

use yarbles\framework\exception\http\BaseHttpException;

class RequestException extends BaseHttpException {

	protected $strError;

	public function __construct($strError) {
		$this->strError = $strError;
		parent::__construct("Request exception: " . $strError);
	}

	public function getError() {
		return $this->strError;
	}

}