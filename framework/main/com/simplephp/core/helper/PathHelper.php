<?php
namespace com\simplephp\core\helper;

use com\simplephp\web\common\ServiceLocator;
use com\simplephp\core\helper\VersionHelper;

/**
 * Path helper
 * @author Richard Hoppes
 */
class PathHelper {
	/**
	 * Create JavaScript file path
	 * @static
	 * @param string $strFileLocation
	 * @param boolean $boolForceCacheRefresh
	 * @return string
	 */
	public static function createJsPath($strFileLocation, $boolForceCacheRefresh) {
		$objConfig = ServiceLocator::getConfig();
		return $objConfig->getProperty("js_path") . "/" . $strFileLocation . ($boolForceCacheRefresh ? "?".VersionHelper::getVersionHash() : "");
	}

	/**
	 * Create css path
	 * @static
	 * @param string $strFileLocation
	 * @param bool $boolForceCacheRefresh
	 * @return string
	 */
	public static function createCssPath($strFileLocation, $boolForceCacheRefresh) {
		$objConfig = ServiceLocator::getConfig();
		return $objConfig->getProperty("css_path") . "/" . $strFileLocation . ($boolForceCacheRefresh ? "?".VersionHelper::getVersionHash() : "");
	}

	/**
	 * Create image file path
	 * @static
	 * @param string $strFileLocation
	 * @return string
	 */
	public static function createImgPath($strFileLocation = "") {
		$objConfig = ServiceLocator::getConfig();
		return $objConfig->getProperty("img_path") . "/" . $strFileLocation;
	}

}