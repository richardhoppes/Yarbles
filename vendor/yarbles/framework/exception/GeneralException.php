<?php
namespace yarbles\framework\exception;

use yarbles\framework\common\YarblesLocator;

class GeneralException extends \Exception {

	protected $intExceptionCode = null;
	protected $objConfig;

	public function __construct($strMessage = "General Exception", $intExceptionCode = null) {
		parent::__construct($strMessage);

		if($intExceptionCode) {
			$this->intExceptionCode = $intExceptionCode;
		}

		// TODO: Inject this
		$this->objConfig = YarblesLocator::getConfig();
	}

	public function getExceptionName() {
		$strChildClass = get_class($this);
		$intLastSlashPos = strrpos($strChildClass, "\\");

		if($intLastSlashPos && strlen($strChildClass) > $intLastSlashPos + 1) {
			$strException = substr($strChildClass, $intLastSlashPos + 1);
		} else {
			$strException = $strChildClass;
		}
		
		return $strException;
	}

	/**
	 * Returns exception code
	 * 1. If a code was provided when the exception was thrown, use that
	 * 2. If no code was provided, look up the code for the child exception in the config
	 * 3. If no code was found in the config for the child exception, look up the general exception code
	 * 4. If no general exception code was found, something is really f'd up.  Return 0.
	 */
	public function getExceptionCode() {
		$retVal = 0;

		if($this->intExceptionCode != null) {
			$retVal = $this->intExceptionCode;
		} else {
			try {
				$retVal = $this->objConfig->getProperty('exception_code_'.$this->getExceptionName());
			} catch (\Exception $e){
				try {
					$retVal = $this->objConfig->getProperty('exception_code_general');
				} catch (\Exception $e){}
			}
		}

		return $retVal;
	}

	/**
	 * Returns exception message
	 * 1. Check config for message override
	 * 2. If no message override was found in the config, return the actual exception message
	 */
	public function getExceptionMessage() {
		try {
			return $this->objConfig->getProperty('exception_message_'.$this->getExceptionName());
		} catch (\Exception $e){
			return $this->getMessage();
		}
	}

}