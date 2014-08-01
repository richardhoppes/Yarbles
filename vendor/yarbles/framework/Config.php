<?php
namespace yarbles\framework;

use yarbles\framework\ConfigInterface;

/**
 * Application config
 * Reads values from application and framework config files
 * @author Richard Hoppes
 */
class Config implements ConfigInterface {
	
	private static $objConfig;
	
	private $strAppConfigPath;
	private $strFrameworkConfigPath;
	private $strEnvironment;
	private $strDefaultEnvironment;

	public function __construct() {
		$this->strEnvironment = ENVIRONMENT;
		$this->strDefaultEnvironment = DEFAULT_ENVIRONMENT; 
		$this->strAppConfigPath = APP_CONFIG_PATH;
		$this->strFrameworkConfigPath = FRAMEWORK_CONFIG_PATH;
	}
	
	public static function getHandle() {
		if(!self::$objConfig) {
			self::$objConfig = new self();
		}
		return self::$objConfig;
	}
	
	public function getProperty($strName) {
		$strName = strtolower($strName);

		// Not very efficient to do this every time, but it keeps it out of stack traces
		$arrAppConfig = parse_ini_file($this->strAppConfigPath, true);
		$arrFrameworkConfig = parse_ini_file($this->strFrameworkConfigPath, true);

		$mxdReturn = null;
		// App Config
		if(isset($arrAppConfig[$this->strEnvironment][$strName])) {
			$mxdReturn = $arrAppConfig[$this->strEnvironment][$strName];
		} elseif($this->strDefaultEnvironment != $this->strEnvironment && isset($arrAppConfig[$this->strDefaultEnvironment][$strName])) {
			$mxdReturn = $arrAppConfig[$this->strDefaultEnvironment][$strName];
		// Framework Config
		} elseif(isset($arrFrameworkConfig[$this->strEnvironment][$strName])) {
			$mxdReturn = $arrFrameworkConfig[$this->strEnvironment][$strName];
		} elseif($this->strDefaultEnvironment != $this->strEnvironment && isset($arrFrameworkConfig[$this->strDefaultEnvironment][$strName])) {
			$mxdReturn = $arrFrameworkConfig[$this->strDefaultEnvironment][$strName];
		// Durr...not found!
		} else {
			throw new \Exception("Invalid config property {$strName}.  Please validate configuration.");
		}

		// TODO: DO a preg_match_all
		// TODO: Store in array so this lookup doesn't need to happen everytime
		if($mxdReturn != null && preg_match("/\#\{([^}]*)\}/i", $mxdReturn, $arrMatch)) {
			if(isset($arrMatch[1])) {
				$strReplacement = $this->getProperty($arrMatch[1]);
				$mxdReturn = str_replace($arrMatch[0], $strReplacement, $mxdReturn);
			}
		}
		
		return $mxdReturn;
	}
	
	
	public function __get($strName) {
		return $this->getProperty($strName);
	}
	
	public function getEnvironment() {
		return $this->strEnvironment;
	}
	
	public function getConfigPath() {
		return $this->strConfigPath;
	}
	
	public function getDefaultEnvironment() {
		return $this->strDefaultEnvironment;
	}

}