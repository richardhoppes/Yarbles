<?
namespace yarbles\framework;

interface ConfigInterface {

	public static function getHandle();

	public function getProperty($strName);

	public function getEnvironment();

	public function getConfigPath();

	public function getDefaultEnvironment();

	public function getAppConfig();

	public function getFrameworkConfig();
	
}