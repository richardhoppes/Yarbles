<?php

class State {
	const STATE_KEY = "state_key";

	protected static $objState = null;
	protected $arrStateVariables = array();

	protected function __construct() {
		$this->updateSession();
	}

	public static function getHandle() {
		if(!self::$objState) {
			try {
				$objSession = Session::getHandle();
				self::$objState = $objSession->getKey(self::STATE_KEY);
			} catch(Exception $e) {
				self::$objState = new self();
			}
		}
		return self::$objState;
	}

	protected function setVariable($strVariableName, $mxdValue) {
		$this->arrStateVariables[$strVariableName] = $mxdValue;
	}

	protected function getVariable($strVariableName) {
		$mxdReturn = null;
		if(isset($this->arrStateVariables[$strVariableName]))
			$mxdReturn = $this->arrStateVariables[$strVariableName];
		return $mxdReturn;
	}

	protected function updateSession() {
		$objSession = Session::getHandle();
		$objSession->setKey(self::STATE_KEY, $this);
	}
}