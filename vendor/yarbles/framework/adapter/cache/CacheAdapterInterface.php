<?
namespace yarbles\framework\adapter\cache;

/**
 * Cache adapter interface
 * @author Richard Hoppes
 */
interface CacheAdapterInterface {

	public function getItem($strKey);

	public function setItem($strKey, $mxdValue);

	public function deleteItem($strKey);

	public function flush();

	public function getTotalSpace();

	public function getAvailableSpace();

	public function clearExpired();

}