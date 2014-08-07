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
	private $arrAppConfig;
	private $arrFrameworkConfig;

	private function __construct($strEnvironment, $strDefaultEnvironment, $strAppConfigPath, $strFrameworkConfigPath) {
		$this->strEnvironment = $strEnvironment;
		$this->strDefaultEnvironment = $strDefaultEnvironment;
		$this->strAppConfigPath = $strAppConfigPath;
		$this->strFrameworkConfigPath = $strFrameworkConfigPath;

		$this->arrAppConfig = parse_ini_file($this->strAppConfigPath, true);
		$this->arrFrameworkConfig = parse_ini_file($this->strFrameworkConfigPath, true);
	}

	public static function getHandle($strEnvironment, $strDefaultEnvironment, $strAppConfigPath, $strFrameworkConfigPath) {
		if(!self::$objConfig) {
			self::$objConfig = new self($strEnvironment, $strDefaultEnvironment, $strAppConfigPath, $strFrameworkConfigPath);
		}
		return self::$objConfig;
	}
	
	public function getProperty($strName) {
		$strName = strtolower($strName);

		$mxdReturn = null;
		// App Config
		if(isset($this->arrAppConfig[$this->strEnvironment][$strName])) {
			$mxdReturn = $this->arrAppConfig[$this->strEnvironment][$strName];
		} elseif($this->strDefaultEnvironment != $this->strEnvironment && isset($this->arrAppConfig[$this->strDefaultEnvironment][$strName])) {
			$mxdReturn = $this->arrAppConfig[$this->strDefaultEnvironment][$strName];
		// Framework Config
		} elseif(isset($this->arrFrameworkConfig[$this->strEnvironment][$strName])) {
			$mxdReturn = $this->arrFrameworkConfig[$this->strEnvironment][$strName];
		} elseif($this->strDefaultEnvironment != $this->strEnvironment && isset($this->arrFrameworkConfig[$this->strDefaultEnvironment][$strName])) {
			$mxdReturn = $this->arrFrameworkConfig[$this->strDefaultEnvironment][$strName];
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