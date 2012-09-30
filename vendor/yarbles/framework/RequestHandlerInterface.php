<?
namespace yarbles\framework;

interface RequestHandlerInterface {

	const METHOD_GET = "GET";
	const METHOD_POST = "POST";
	const METHOD_PUT = "PUT";
	const METHOD_DELETE = "DELETE";

	public function validateRequestMethod();

	public function getRequestValue($strKey);

	public function getRequestData();

	public function getRequestMethod();

}
