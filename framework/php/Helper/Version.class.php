<?php 
/**
 * Path helper class
 * @author Richard Hoppes
 */
class Helper_Version {
	/**
	 * Get app version
	 * @return string
	 */
	public static function getVersion() {
		$objConfig = Config::getHandle();
		return $objConfig->app_version;
	}

	/**
	 * Get app revision
	 * @return string
	 */
	public static function getRevision() {
		$objConfig = Config::getHandle();
		return $objConfig->app_revision;
	}

	/**
	 * Get app state
	 * @return string
	 */
	public static function getState() {
		$objConfig = Config::getHandle();
		return $objConfig->app_state;
	}

	/**
	 * Get full app version
	 * @return string
	 */
	public static function getFullVersion() {
		return self::getVersion() . "." . self::getRevision() . "." . self::getState();
	}

	/**
	 * Get full app version for display purposes
	 * @return string
	 */
	public static function getFullVersionDisplay() {
		return "v" . self::getVersion() . "." . self::getRevision() . " " . self::getState();
	}

	/**
	 * Get md5 hash of version (used for css/js cache refresh)
	 * @return string
	 */
	public static function getVersionHash() {
		return md5(self::getVersion());
	}

}