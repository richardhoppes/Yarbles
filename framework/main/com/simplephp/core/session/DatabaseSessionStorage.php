<?
namespace com\simplephp\core\session;

use com\simplephp\core\session\SessionSaveHandlerInterface;

/**
 * Database session storage
 * @author Richard Hoppes
 */
class DatabaseSessionStorage implements SessionSaveHandlerInterface {

	public function open($strSavePath, $strName) {
		// TODO: Implement open() method.
	}

	public function close() {
		// TODO: Implement close() method.
	}

	public function read($strId) {
		// TODO: Implement read() method.
	}

	public function write($strId, $strData) {
		// TODO: Implement write() method.
	}

	public function destroy($strId) {
		// TODO: Implement destroy() method.
	}

	public function clean($intMaxLifetime) {
		// TODO: Implement clean() method.
	}

}