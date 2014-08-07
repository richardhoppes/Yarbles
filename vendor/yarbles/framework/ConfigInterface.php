<?
namespace yarbles\framework;

interface ConfigInterface {

	public static function getHandle($strEnvironment, $strDefaultEnvironment, $strAppConfigPath, $strFrameworkConfigPath);

	public function getProperty($strName);

	public function getEnvironment();

	public function getConfigPath();

	public function getDefaultEnvironment();

}