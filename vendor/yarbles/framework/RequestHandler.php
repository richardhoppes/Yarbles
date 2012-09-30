<?
namespace yarbles\framework;

use yarbles\framework\exception\request\RequestMethodNotAllowedException;

/**
 * Class to handle HTTP requests
 * @author Richard Hoppes
 */
class RequestHandler implements RequestHandlerInterface {

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

	public function getRequestValue($strKey) {
		return $this->arrRequestData[$strKey];
	}

	public function getRequestData() {
		return $this->arrRequestData;
	}

	public function getRequestMethod() {
		return $this->strRequestMethod;
	}

}
