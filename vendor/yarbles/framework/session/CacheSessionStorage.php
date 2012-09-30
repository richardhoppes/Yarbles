<?
namespace yarbles\framework\session;

use yarbles\framework\session\SessionSaveHandlerInterface;
use yarbles\framework\adapter\cache\CacheAdapterInterface;

/**
 * Cache session storage
 * @author Richard Hoppes
 */
class CacheSessionStorage implements SessionSaveHandlerInterface {

	protected $objCacheAdapter;

	public function __construct(CacheAdapterInterface $objCacheAdapter) {
		$this->objCacheAdapter = $objCacheAdapter;
	}

	public function open($strSavePath, $strName) {
		throw new \Exception("Not yet implemented");
	}

	public function close() {
		throw new \Exception("Not yet implemented");
	}

	public function read($strId) {
		throw new \Exception("Not yet implemented");
	}

	public function write($strId, $strData) {
		throw new \Exception("Not yet implemented");
	}

	public function destroy($strId) {
		throw new \Exception("Not yet implemented");
	}

	public function clean($intMaxLifetime) {
		throw new \Exception("Not yet implemented");
	}

}