<?php
/**
 * Database exception class
 * @author Richard Hoppes <rhoppes@gmail.com>
 */
class Exception_Database extends Exception_General {
	public function __construct($strMessage) {
		parent::__construct($strMessage);
	}
}