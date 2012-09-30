<?php
namespace yarbles\framework;

use yarbles\framework\common\YarblesLocator;
use yarbles\framework\ConfigInterface;
use yarbles\framework\AutoloaderInterface;
use yarbles\framework\LookupFactoryInterface;

/**
 * Automagically load classes and interfaces
 * @author Richard Hoppes
 */
class Autoload implements AutoloadInterface {

	public static function load($strClass) {
		$objConfig = YarblesLocator::getConfig();

		$strFile = str_replace("\\", "/", $strClass);
		$strFile = str_replace("_", "/", $strFile);

		// Application
		if(file_exists($objConfig->getProperty("web_path")."/".$strFile.".php")) {
			include_once($objConfig->getProperty("web_path")."/".$strFile.".php");
		}
		// Framework
		elseif(file_exists($objConfig->getProperty("fw_path")."/".$strFile.".php")) {
			include_once($objConfig->getProperty("fw_path")."/".$strFile.".php");
		}
	}

}