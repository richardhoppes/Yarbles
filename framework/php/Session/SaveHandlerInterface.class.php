<?
/**
 * Interface for session save handler implementations
 * @author Richard Hoppes
 */
interface Session_SaveHandlerInterface
{
	public function open($strSavePath, $strName);

	public function close();

	public function read($strId);

	public function write($strId, $strData);

	public function destroy($strId);

	public function clean($intMaxLifetime);
}