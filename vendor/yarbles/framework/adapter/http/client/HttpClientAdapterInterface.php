<?
namespace yarbles\framework\adapter\http\client;

interface HttpClientAdapterInterface {

	const METHOD_POST = "POST";
	const METHOD_GET = "GET";
	const METHOD_DELETE = "DELETE";
	const METHOD_PUT = "PUT";

	const HTTP_VERSION_1_1 = "1.1";
	const HTTP_VERSION_1_0 = "1.0";

	public function connect($strHost, $intPort = 80, $boolSecure = false, $intTimeout = null, $intMaxRedirects = null);

	public function request($strMethod, $strUrl, $strHttpVersion = self::HTTP_VERSION_1_1, $arrHeaders = array(), $mxdBody = '');

	public function getResponse();

	public function getResponseHeader();

	public function getRequest();

	public function close();

}