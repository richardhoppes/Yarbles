<?php
namespace yarbles\framework\helper;

/**
 * String helper
 * @author Richard Hoppes
 */
class StringHelper {

	public static function truncate($strValue, $intMaxLength, $strAppendChars = "...") {
		return (strlen($strValue) > $intMaxLength) ? trim(substr($strValue, 0, $intMaxLength)) . $strAppendChars : $strValue;
	}

}
