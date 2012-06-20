<?php
/**
 * View exception class
 * @author Richard Hoppes <rhoppes@gmail.com>
 */
class Exception_View extends Exception_General {
	public function __construct($strMessage) {
		parent::__construct($strMessage);
	}
}