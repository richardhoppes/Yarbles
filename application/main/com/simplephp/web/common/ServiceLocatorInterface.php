<?
namespace com\simplephp\web\common;

interface ServiceLocatorInterface {

	public static function getConfig();
	
	public static function getReadWriteDatabase();

}