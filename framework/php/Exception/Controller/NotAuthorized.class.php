<?php

class Exception_Controller_NotAuthorized extends Exception_Controller {

	public function __construct() {
		parent::__construct('Not Authorized');
	}

}