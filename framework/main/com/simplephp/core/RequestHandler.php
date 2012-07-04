<?
namespace com\simplephp\core;

use com\simplephp\core\exception\request\RequestMethodNotAllowedException;

/**
 * Class to handle HTTP requests
 * @author Richard Hoppes
 */
class RequestHandler {

	const METHOD_GET = "GET";
	const METHOD_POST = "POST";
	const METHOD_PUT = "PUT";
	const METHOD_DELETE = "DELETE";

	private $strRequestMethod;
	private $arrRequestData;
	private $arrValidRequestMethods = array();

	public function __construct($mxdValidRequestMethods = array()) {
		if(is_array($mxdValidRequestMethods)) {
			$this->arrValidRequestMethods = $mxdValidRequestMethods;
		} else {
			$this->arrValidRequestMethods = array($mxdValidRequestMethods);
		}
		$this->processRequest();
	}

	private function processRequest() {
		$this->strRequestMethod = $_SERVER['REQUEST_METHOD'];

		switch ($_SERVER['REQUEST_METHOD']) {
			case self::METHOD_GET:
				$this->arrRequestData = $_GET;
				break;
			case self::METHOD_POST:
				$this->arrRequestData = $_POST;
				break;
			case self::METHOD_PUT:
			case self::METHOD_DELETE:
				parse_str(file_get_contents('php://input'), $arrPutVars);
				$this->arrRequestData = $arrPutVars;
				break;
		}
	}

	public function validateRequestMethod() {
		if(is_array($this->arrValidRequestMethods) && sizeof($this->arrValidRequestMethods)) {
			if(!in_array($this->strRequestMethod, $this->arrValidRequestMethods)) {
				throw new RequestMethodNotAllowedException($this->strRequestMethod);
			}
		}
	}

	public function getRequestValue($key) {
		return $this->arrRequestData[$key];
	}

	public function getRequestData() {
		return $this->arrRequestData;
	}

	public function getRequestMethod() {
		return $this->strRequestMethod;
	}

}
