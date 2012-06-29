<?php
/**
 * String helper
 * @author Richard Hoppes
 */
class Helper_String {

	public static function truncate($strValue, $intMaxLength, $strAppendChars = "...") {
		return (strlen($strValue) > $intMaxLength) ? substr($strValue, 0, $intMaxLength) . $strAppendChars : $strValue;
	}

}
