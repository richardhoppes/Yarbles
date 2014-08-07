<?
namespace yarbles\web\common;

use yarbles\framework\common\YarblesLocator;

class CacheLocator
{
	public static function getCache()
	{
		return YarblesLocator::getCacheAdapter(
			YarblesLocator::getConfig()->getProperty("cache_adapter"),
			YarblesLocator::getConfig()->getProperty("cache_server"),
			YarblesLocator::getConfig()->getProperty("cache_port")
		);
	}
}