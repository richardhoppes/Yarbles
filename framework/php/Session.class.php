<?php
/**
 * Class for handling session variables
 * TODO: Allow storing sessions in other ways (sqlite, mysql, etc...)
 * @throws Exception
 * @author Richard Hoppes <rhoppes@gmail.com>
 */
class Session
{
	private static $objSession;

	/**
	 * Constructor
	 */
	private function __construct() {
		session_start();
		if (!isset($_SESSION['session_started']) || $_SESSION['session_started'] == false) {
			@session_register('main');
			$_SESSION['session_started'] = true;
		}
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
	function setKey($strKey, $strValue) {
		$_SESSION[$strKey] = $strValue;
	}

	/**
	 * Return the value for a given key
	 * @param string $strKey
	 * @return #E#V_SESSION|?
	 */
	function getKey($strKey) {
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
	function unsetKey($strKey) {
		if(isset($_SESSION[$strKey])) {
			unset($_SESSION[$strKey]);
		}
	}

	/**
	 * Print the entire session to the screen
	 */
	function dumpSession() {
		echo "<pre>\n";
		print_r($_SESSION);
		echo "</pre>\n";
	}

}