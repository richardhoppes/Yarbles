<?php
namespace yarbles\framework\helper;

use yarbles\framework\common\YarblesLocator;

/**
 * Version helper class
 * @author Richard Hoppes
 */
class FrameworkVersionHelper {
	/**
	 * Get app name
	 */
	public static function getName() {
		$objConfig = YarblesLocator::getConfig();
		return $objConfig->fw_name;
	}

	/**
	 * Get app version
	 * @return string
	 */
	public static function getVersion() {
		$objConfig = YarblesLocator::getConfig();
		return $objConfig->fw_version;
	}

	/**
	 * Get app revision
	 * @return string
	 */
	public static function getRevision() {
		$objConfig = YarblesLocator::getConfig();
		return $objConfig->fw_revision;
	}

	/**
	 * Get app state
	 * @return string
	 */
	public static function getState() {
		$objConfig = YarblesLocator::getConfig();
		return $objConfig->fw_state;
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

}