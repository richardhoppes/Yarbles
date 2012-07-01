<?php
namespace com\simplephp\core\exception\request;

use com\simplephp\core\exception\request\BaseRequestException;

class RequestMethodNotAllowedException extends BaseRequestException {
	protected $strRequestMethod;

	public function __construct($strRequestMethod) {
		$this->strRequestMethod = $strRequestMethod;
		parent::__construct('Invalid Request');
	}

	public function getRequestMethod() {
		return $this->strRequestMethod;
	}
}