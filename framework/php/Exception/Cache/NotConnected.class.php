<?php

class Exception_Cache_NotConnected extends Exception_Controller {
	public function __construct() {
		parent::__construct('Cache server is not connected');
	}
}