<?php 
/**
 * Path helper class
 * @author Richard Hoppes <rhoppes@gmail.com>
 */
class Helper_Path {
	/**
	 * Create JavaScript file path
	 * @static
	 * @param string $strFileLocation
	 * @param boolean $boolForceCacheRefresh
	 * @return string
	 */
	public static function createJsPath($strFileLocation, $boolForceCacheRefresh) {
        $objConfig = Config::getHandle();
		return $objConfig->JS_PATH . "/" . $strFileLocation . ($boolForceCacheRefresh ? "?".Helper_Version::getVersionHash() : "");
	}

	/**
	 * Create css path
	 * @static
	 * @param string $strFileLocation
	 * @param bool $boolForceCacheRefresh
	 * @return string
	 */
	public static function createCssPath($strFileLocation, $boolForceCacheRefresh) {
        $objConfig = Config::getHandle();
		return $objConfig->CSS_PATH . "/" . $strFileLocation . ($boolForceCacheRefresh ? "?".Helper_Version::getVersionHash() : "");
	}

	/**
	 * Create image file path
	 * @static
	 * @param string $strFileLocation
	 * @return string
	 */
	public static function createImgPath($strFileLocation = "") {
        $objConfig = Config::getHandle();
		return $objConfig->IMG_PATH . "/" . $strFileLocation;
	}

	/**
	 * Create swf path
	 * @static
	 * @param string $strFileLocation
	 * @return string
	 */
	public static function createSwfPath($strFileLocation) {
        $objConfig = Config::getHandle();
		return $objConfig->SWF_PATH . "/" . $strFileLocation;
	}
}