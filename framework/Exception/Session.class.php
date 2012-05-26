<?php
/**
 * Session exception
 * @author Richard Hoppes <rhoppes@gmail.com>
 */
class Exception_Session extends Exception_General {
	public function __construct($strMessage) {
		parent::__construct($strMessage);
	}
}