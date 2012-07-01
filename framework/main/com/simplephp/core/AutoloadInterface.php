<?
namespace com\simplephp\core;

use com\simplephp\core\ConfigInterface;

interface AutoloadInterface {

	public static function load($strClass, ConfigInterface $objConfig);

}