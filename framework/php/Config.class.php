<?php
/**
 * Application config
 * Reads values from /application/config/config.ini
 * @author Richard Hoppes
 */
class Config {
	
	private static $objConfig;
	
	private $strConfigPath;
	private $strEnvironment;
	private $strDefaultEnvironment;
	private $arrConfig;
	
	public function __construct() {
		$this->strConfigPath = CONFIG_PATH;
		$this->strEnvironment = ENVIRONMENT;
		$this->strDefaultEnvironment = DEFAULT_ENVIRONMENT;
		$this->arrConfig = parse_ini_file($this->strConfigPath, true);
	}
	
	public static function getHandle() {
		if(!self::$objConfig) {
			self::$objConfig = new self();
		}
		return self::$objConfig;
	}
	
	public function getProperty($strName) {
		$strName = strtolower($strName);

		$mxdReturn = null;
		if(isset($this->arrConfig[$this->strEnvironment][$strName])) {
			$mxdReturn = $this->arrConfig[$this->strEnvironment][$strName];
		} elseif($this->strDefaultEnvironment != $this->strEnvironment && isset($this->arrConfig[$this->strDefaultEnvironment][$strName])) {
			$mxdReturn = $this->arrConfig[$this->strDefaultEnvironment][$strName];
		} else {
			throw new Exception("Invalid config property {$strName}.  Please validate configuration.");
		}
		
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
	
	public function getConfig() {
		return $this->arrConfig;
	}

}