<?
namespace com\simplephp\core\adapter\http\client;

interface HttpClientAdapterInterface {

	const METHOD_POST = "POST";
	const METHOD_GET = "GET";
	const METHOD_DELETE = "DELETE";
	const METHOD_PUT = "PUT";

	public function connect($strHost, $intPort = 80, $boolSecure = false);

	public function write($strMethod, $strUrl, $httpVersion = '1.1', $arrHeaders = array(), $strbody = '');

	public function read();

	public function close();

}