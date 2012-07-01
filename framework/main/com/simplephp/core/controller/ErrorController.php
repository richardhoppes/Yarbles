<?php
namespace com\simplephp\core\controller;

use com\simplephp\core\Controller;
use com\simplephp\core\ConfigInterface;
use com\simplephp\core\exception\view\ViewNotFoundException;

class ErrorController extends Controller {
	public function __construct(ConfigInterface $objConfig) {
		parent::__construct($objConfig);
	}

	public function pageNotFound($e) {
		header("HTTP/1.1 404 Not Found");
		$arrParams = array();
		$arrParams['code'] = 404;
		$arrParams['title'] = '404 Not Found';
		$arrParams['message'] = 'The page you requested could not be found.';
		$arrParams['exception'] = $e;
		$this->loadView('Error_404', $arrParams);
	}

	public function notAuthorized($e) {
		header("HTTP/1.1 403 Forbidden");
		$arrParams = array();
		$arrParams['code'] = 403;
		$arrParams['title'] = '403 Forbidden';
		$arrParams['message'] = 'You are not authorized to view this page.';
		$arrParams['exception'] = $e;
		$this->loadView('Error_403', $arrParams);
	}

	public function internalServerError($e) {
		header("HTTP/1.1 500 Internal Server Error");
		$arrParams = array();
		$arrParams['code'] = 500;
		$arrParams['title'] = '500 Internal Server Error';
		$arrParams['message'] = 'There was a problem displaying the page you requested.';
		$arrParams['exception'] = $e;
		$this->loadView('Error_500', $arrParams);
	}

	public function methodNotAllowed($e) {
		header("HTTP/1.1 405 Method Not Allowed");
		$arrParams = array();
		$arrParams['code'] = 405;
		$arrParams['title'] = '405 Method Not Allowed';
		$arrParams['message'] = 'The request method you are using is not allowed.';
		$arrParams['exception'] = $e;
		$this->loadView('Error_405', $arrParams);
	}

	public function general($e) {
		$arrParams = array();
		$arrParams['code'] = null;
		$arrParams['title'] = 'Oops! Something is broken!';
		$arrParams['message'] = 'The page you requested could not be opened.';
		$arrParams['exception'] = $e;
		$this->loadView('Error_Default', $arrParams);
	}

	public function loadView($strView, $arrParams = array()) {
		try {
			parent::loadView($strView, $arrParams);
		} catch (ViewNotFoundException $e) {
			parent::loadView('error_default', $arrParams);
		}
	}
}