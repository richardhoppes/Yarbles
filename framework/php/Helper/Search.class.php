<?php
class Helper_Search {

	public static function searchizeString($strString) 
	{
		$strString = str_replace(".", "", $strString);
		$strString = str_replace(":", "", $strString);
		$strString = str_replace("&", "AND", $strString);
		$strString = str_replace("'", "", $strString);
		$strString = str_replace(";", "", $strString);
		$strString = str_replace("-", " ", $strString);
		$strString = str_replace(",", "", $strString);
		$strString = strtolower($strString);
		
		return $strString;
	}

    // TODO: This is MySQL specific - should move this somewhere else
	public static function searchizeField($strField)
	{
		$strStripSql = "
		REPLACE(
		REPLACE(
		REPLACE(
		REPLACE(
		REPLACE(
		REPLACE(
		REPLACE({$strField}, '.', '')
		,':','')
		,'&','AND')
		,\"'\",'')
		,';','')
		,'-',' ')
		,',','')
		";
		
		return $strStripSql;
	}
	
}
?>