<?php
/**
 * General exception class
 * @author Richard Hoppes <rhoppes@gmail.com>
 */
class Exception_General extends Exception {
	public function __construct($strMessage = "Unspecified Exception") {
		parent::__construct("{$strMessage}");
	}
}