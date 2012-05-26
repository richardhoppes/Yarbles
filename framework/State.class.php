<?php
/**
 * Class to keep application state
 * Not fully implemented yet.
 * @author Richard Hoppes <rhoppes@gmail.com>
 */
class State {
	protected static $objState = null;
	protected $arrStateVariables = array();

	/**
	 * Constructor
	 */
	protected function __construct() {
		$this->updateSession();
	}

	/**
	 * Set application state variable
	 * @param string $strVariableName
	 * @param mixed $mxdValue
	 * @return void
	 */
	protected function setVariable($strVariableName, $mxdValue) {
		$this->arrStateVariables[$strVariableName] = $mxdValue; 
	}

	/**
	 * Get application state variable
	 * @param string $strVariableName
	 * @return mixed
	 */
	protected function getVariable($strVariableName) {
		$mxdReturn = null;
		if(isset($this->arrStateVariables[$strVariableName]))	
			$mxdReturn = $this->arrStateVariables[$strVariableName];
		return $mxdReturn;
	}

	/**
	 * Saves key value in session under 'state' key
	 * @return void
	 */
	protected function updateSession() {
		$objSession = Session::getHandle();
		$objSession->setKey('state', $this);
	}
}