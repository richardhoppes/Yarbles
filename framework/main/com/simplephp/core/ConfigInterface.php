<?
namespace com\simplephp\core;

interface ConfigInterface {

	public static function getHandle();

	public function getProperty($strName);

	public function getEnvironment();

	public function getConfigPath();

	public function getDefaultEnvironment();

	public function getConfig();

}