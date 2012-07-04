<?php
namespace com\simplephp\core\helper;

use com\simplephp\web\common\ServiceLocator;

/**
 * Path helper class
 * @author Richard Hoppes
 */
class VersionHelper {
	/**
	 * Get app version
	 * @return string
	 */
	public static function getVersion() {
		$objConfig = ServiceLocator::getConfig();
		return $objConfig->getProperty('app_version');
	}

	/**
	 * Get app revision
	 * @return string
	 */
	public static function getRevision() {
		$objConfig = ServiceLocator::getConfig();
		return $objConfig->getProperty('app_revision');
	}

	/**
	 * Get app state
	 * @return string
	 */
	public static function getState() {
		$objConfig = ServiceLocator::getConfig();
		return $objConfig->getProperty('app_state');
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
		$objConfig = ServiceLocator::getConfig();
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