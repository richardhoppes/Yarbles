<?php
namespace yarbles\framework\controller;

use yarbles\framework\Controller;
use yarbles\framework\exception\view\ViewNotFoundException;

/**
 * Error controller
 * @author Richard Hoppes
 */
class ErrorController extends Controller {

	public function resourceNotFound($e) {
		header("HTTP/1.1 404 Not Found");
		$arrParams = array();
		$arrParams['http_response_code'] = 404;		
		$arrParams['http_response'] = '404 Not Found';
		$arrParams['error_message'] = $e->getExceptionMessage();
		$arrParams['error_code'] = $e->getExceptionCode();
		$this->loadView('error_404', $arrParams);
	}

	public function notAuthorized($e) {
		header("HTTP/1.1 403 Forbidden");
		$arrParams = array();
		$arrParams['http_response_code'] = 403;		
		$arrParams['http_response'] = '403 Forbidden';
		$arrParams['error_message'] = $e->getExceptionMessage();
		$arrParams['error_code'] = $e->getExceptionCode();
		$this->loadView('error_403', $arrParams);
	}

	public function internalServerError($e) {
		header("HTTP/1.1 500 Internal Server Error");
		$arrParams = array();
		$arrParams['http_response_code'] = 500;
		$arrParams['http_response'] = '500 Internal Server Error';
		$arrParams['error_message'] = $e->getExceptionMessage();
		$arrParams['error_code'] = $e->getExceptionCode();
		$this->loadView('error_500', $arrParams);
	}

	public function methodNotAllowed($e) {
		header("HTTP/1.1 405 Method Not Allowed");
		$arrParams = array();
		$arrParams['http_response_code'] = 405;
		$arrParams['http_response'] = '405 Method Not Allowed';
		$arrParams['error_message'] = $e->getExceptionMessage();
		$arrParams['error_code'] = $e->getExceptionCode();
		$this->loadView('error_405', $arrParams);
	}

	public function badRequest($e) {
		header("HTTP/1.1 400 Bad Request");
		$arrParams = array();
		$arrParams['http_response_code'] = 400;
		$arrParams['http_response'] = '400 Bad Request';
		$arrParams['error_message'] = $e->getExceptionMessage();
		$arrParams['error_code'] = $e->getExceptionCode();
		$this->loadView('error_400', $arrParams);
	}

	public function general($e) {
		header("HTTP/1.1 500 Internal Server Error");
		$arrParams = array();
		$arrParams['http_response_code'] = 500;
		$arrParams['http_response'] = '500 Internal Server Error';
		$arrParams['error_message'] = "Uh ohs, something broke.  The code monkeys have been notified."; // TODO: This message should be configurable
		$arrParams['error_code'] = @$e->getExceptionCode();
		$this->loadView('error_default', $arrParams);
	}

	public function loadView($strView, $arrParams = array()) {
		try {
			parent::loadView($strView, $arrParams);
		} catch (ViewNotFoundException $e) {
			parent::loadView('error_default', $arrParams);
		}
	}
}