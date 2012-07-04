<?php
namespace com\simplephp\core\exception;

class GeneralException extends \Exception {
	public function __construct($strMessage = "Unspecified Exception") {
		parent::__construct("{$strMessage}");
	}
}