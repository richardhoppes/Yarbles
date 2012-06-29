<?
/**
 * Database adapter interface
 * @author Richard Hoppes
 */
interface Adapter_Database_Interface {

	const QUERY_TYPE_SELECT = 'QUERY_TYPE_SELECT';
	const QUERY_TYPE_DELETE = 'QUERY_TYPE_DELETE';
	const QUERY_TYPE_UPDATE = 'QUERY_TYPE_UPDATE';
	const QUERY_TYPE_INSERT = 'QUERY_TYPE_INSERT';
	const QUERY_TYPE_CREATE = 'QUERY_TYPE_CREATE';
	const QUERY_TYPE_DROP = 'QUERY_TYPE_DROP';

	public function query($strQuery, $arrVariables = array(), $strQueryType = self::QUERY_TYPE_SELECT);

	public function prepareValue($strValue);
}