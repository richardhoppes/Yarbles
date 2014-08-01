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

	public function getTotalBytes();

	public function getAvailableBytes();

	public function dumpStats();

}