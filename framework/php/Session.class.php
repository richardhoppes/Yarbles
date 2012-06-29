<?php
// TODO: Soon to be deprecated
class Session {

	const SESSION_REGISTER_NAME = "session_main";

	private static $objSession;

	private function __construct() {
		session_start();
		if (!isset($_SESSION['session_started']) || $_SESSION['session_started'] == false) {
			@session_register(self::SESSION_REGISTER_NAME);
			$_SESSION['session_started'] = true;
		}
	}

	public static function getHandle() {
		if(!self::$objSession) {
			self::$objSession = new self();
		}
		return self::$objSession;
	}

	function setKey($strKey, $strValue) {
		$_SESSION[$strKey] = $strValue;
	}

	function getKey($strKey) {
		if(isset($_SESSION[$strKey])) {
			return $_SESSION[$strKey];
		} else {
			throw new Exception_Session_UnknownKey($strKey);
		}
	}

	function unsetKey($strKey) {
		if(isset($_SESSION[$strKey])) {
			unset($_SESSION[$strKey]);
		}
	}

	function asString() {
		return print_r($_SESSION);
	}

	function asJson() {
		return json_encode($_SESSION);
	}

}