<?php
namespace yarbles\framework;

class Session
{
	private static $objSession;

	/**
	 * Constructor
	 */
	private function __construct() {
		session_start();
	}

	/**
	 * Ensure that only one instance of this class is created
	 */
	public static function getHandle() {
		if(!self::$objSession) {
			self::$objSession = new self();
		}
		return self::$objSession;
	}

	/**
	 * Set a key/value pair in the session
	 * @param string $strKey
	 * @param string $strValue
	 */
	public function setKey($strKey, $strValue) {
		$_SESSION[$strKey] = $strValue;
	}

	/**
	 * Return the value for a given key
	 * @param string $strKey
	 * @return #E#V_SESSION|?
	 */
	public function getKey($strKey) {
		if(isset($_SESSION[$strKey])) {
			return $_SESSION[$strKey];
		} else {
			throw new Exception_Session_UnknownKey($strKey);
		}
	}

	/**
	 * Remove a key from the session
	 * @param string $strKey
	 */
	public function unsetKey($strKey) {
		if(isset($_SESSION[$strKey])) {
			unset($_SESSION[$strKey]);
		}
	}

	/**
	 * Print the entire session to the screen
	 */
	public function dumpSession() {
		echo "<pre>\n";
		print_r($_SESSION);
		echo "</pre>\n";
	}

	/**
	 * Reset session
	 */
	public function reset() {
		// Clear session vars
		session_unset();

		// Create new session id
		session_regenerate_id(false);
	}

	/**
	 * Get session id
	 */
	public function getSessionId() {
		return session_id();
	}

}