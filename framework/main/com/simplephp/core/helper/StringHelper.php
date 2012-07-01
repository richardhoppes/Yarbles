<?php
namespace com\simplephp\core\helper;

/**
 * String helper
 * @author Richard Hoppes
 */
class StringHelper {

	public static function truncate($strValue, $intMaxLength, $strAppendChars = "...") {
		return (strlen($strValue) > $intMaxLength) ? substr($strValue, 0, $intMaxLength) . $strAppendChars : $strValue;
	}

}
