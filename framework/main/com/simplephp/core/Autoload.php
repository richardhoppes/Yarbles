<?php
namespace com\simplephp\core;

use com\simplephp\web\common\ServiceLocator;

use com\simplephp\core\ConfigInterface;
use com\simplephp\core\AutoloaderInterface;
use com\simplephp\core\LookupFactoryInterface;

/**
 * Automagically load classes and interfaces
 * @author Richard Hoppes
 */
class Autoload implements AutoloadInterface {

	public static function load($strClass) {
		$objConfig = ServiceLocator::getConfig();

		$strFile = str_replace("\\", "/", $strClass);
		$strFile = str_replace("_", "/", $strFile);

		// Application
		if(file_exists($objConfig->getProperty("app_web_path")."/".$strFile.".php")) {
			include_once($objConfig->getProperty("app_web_path")."/".$strFile.".php");
		}
		// Framework
		elseif(file_exists($objConfig->getProperty("fw_core_path")."/".$strFile.".php")) {
			include_once($objConfig->getProperty("fw_core_path")."/".$strFile.".php");
		}

		// Write condition(s) for autoloading extensions
		//include_once($objConfig->EXT_PATH . "/Json.ext.php");
		//include_once($objConfig->EXT_PATH . "/OAuth.ext.php");
	}

}