<?php

class Exception_Controller extends Exception_General {
	public function __construct($strMessage) {
		parent::__construct($strMessage);
	}
}