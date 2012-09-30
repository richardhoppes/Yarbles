<?php
namespace yarbles\framework\helper;

use yarbles\framework\common\YarblesLocator;
use yarbles\framework\helper\AppVersionHelper;

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
		$objConfig = YarblesLocator::getConfig();
		return $objConfig->getProperty("js_path") . "/" . $strFileLocation . ($boolForceCacheRefresh ? "?".AppVersionHelper::getVersionHash() : "");
	}

	/**
	 * Create css path
	 * @static
	 * @param string $strFileLocation
	 * @param bool $boolForceCacheRefresh
	 * @return string
	 */
	public static function createCssPath($strFileLocation, $boolForceCacheRefresh) {
		$objConfig = YarblesLocator::getConfig();
		return $objConfig->getProperty("css_path") . "/" . $strFileLocation . ($boolForceCacheRefresh ? "?".AppVersionHelper::getVersionHash() : "");
	}

	/**
	 * Create image file path
	 * @static
	 * @param string $strFileLocation
	 * @return string
	 */
	public static function createImgPath($strFileLocation = "") {
		$objConfig = YarblesLocator::getConfig();
		return $objConfig->getProperty("img_path") . "/" . $strFileLocation;
	}

}