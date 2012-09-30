<?php
namespace yarbles\framework\exception\http;

use yarbles\framework\exception\http\BaseHttpException;

class UnsupportedHttpVersionException extends BaseHttpException {

	protected $strHttpVersion;

	public function __construct($strHttpVersion) {
		$this->strHttpVersion = $strHttpVersion;
		parent::__construct("Unsupported http version: {$strHttpVersion}");
	}

	public function getHttpVersion() {
		return $strHttpVersion;
	}

}