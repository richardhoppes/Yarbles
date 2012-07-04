<?php
namespace com\simplephp\core\helper;

use com\simplephp\core\ConfigInterface;

/**
 * Path helper class
 * @author Richard Hoppes
 */
class VersionHelper {
	/**
	 * Get app version
	 * @return string
	 */
	public static function getVersion(ConfigInterface $objConfig) {
		return $objConfig->app_version;
	}

	/**
	 * Get app revision
	 * @return string
	 */
	public static function getRevision(ConfigInterface $objConfig) {
		return $objConfig->app_revision;
	}

	/**
	 * Get app state
	 * @return string
	 */
	public static function getState(ConfigInterface $objConfig) {
		return $objConfig->app_state;
	}

	/**
	 * Get full app version
	 * @return string
	 */
	public static function getFullVersion(ConfigInterface $objConfig) {
		return self::getVersion($objConfig) . "." . self::getRevision($objConfig) . "." . self::getState($objConfig);
	}

	/**
	 * Get full app version for display purposes
	 * @return string
	 */
	public static function getFullVersionDisplay(ConfigInterface $objConfig) {
		return "v" . self::getVersion($objConfig) . "." . self::getRevision($objConfig) . " " . self::getState($objConfig);
	}

	/**
	 * Get md5 hash of version (used for css/js cache refresh)
	 * @return string
	 */
	public static function getVersionHash(ConfigInterface $objConfig) {
		return md5(self::getVersion($objConfig));
	}

}