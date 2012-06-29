<?
/**
 * Class to handle HTTP requests
 * @author Richard Hoppes
 */
class Request {

	const REQUEST_METHOD_GET = "GET";
	const REQUEST_METHOD_POST = "POST";
	const REQUEST_METHOD_PUT = "PUT";
	const REQUEST_METHOD_DELETE = "DELETE";

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
			case self::REQUEST_METHOD_GET:
				$this->arrRequestData = $_GET;
				break;
			case self::REQUEST_METHOD_POST:
				$this->arrRequestData = $_POST;
				break;
			case self::REQUEST_METHOD_PUT:
			case self::REQUEST_METHOD_DELETE:
				parse_str(file_get_contents('php://input'), $arrPutVars);
				$this->arrRequestData = $arrPutVars;
				break;
		}
	}

	public function validateRequestMethod() {
		if(is_array($this->arrValidRequestMethods) && sizeof($this->arrValidRequestMethods)) {
			if(!in_array($this->strRequestMethod, $this->arrValidRequestMethods)) {
				throw new Exception_Request_MethodNotAllowed($this->strRequestMethod);
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
