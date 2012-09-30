<?
namespace yarbles\framework\session;

use yarbles\framework\session\SessionSaveHandlerInterface;
use yarbles\framework\adapter\database\DatabaseAdapterInterface;

/**
 * Database session storage
 * @author Richard Hoppes
 */
class DatabaseSessionStorage implements SessionSaveHandlerInterface {

	protected $objDatabaseAdapter;

	public function __construct(DatabaseAdapterInterface $objDatabaseAdapter) {
		$this->objDatabaseAdapter = $objDatabaseAdapter;
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