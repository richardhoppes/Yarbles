<?php
namespace yarbles\framework;

use yarbles\framework\common\YarblesLocator;
use yarbles\framework\ControllerInterface;
use yarbles\framework\exception\view\ViewNotFoundException;

/**
 * Abstract controller class
 * @author Richard Hoppes
 */
abstract class Controller implements ControllerInterface {

	protected $objConfig;
	protected $objSession;

	public function __construct() {
		// TODO: This should be injected
		$this->objConfig = YarblesLocator::getConfig();
		$this->objSession = YarblesLocator::getSession();
	}

	public function loadView($strView, $arrParams = array()) {
		// Look for application view first
		if(file_exists($this->objConfig->getProperty("web_view_path") . '/' . str_replace('_', '/', $strView ) . ".php")) {
			include_once($this->objConfig->getProperty("web_view_path") . '/' . str_replace('_', '/', $strView ) . ".php");
		// Fall back to framework view
		} elseif(file_exists($this->objConfig->getProperty("fw_view_path") . '/' . str_replace('_', '/', $strView ) . ".php")) {
			include_once($this->objConfig->getProperty("fw_view_path") . '/' . str_replace('_', '/', $strView ) . ".php");
		// If no view exists, throw exception
		} else {
			throw new ViewNotFoundException($strView);
		}
	}

	public function redirect($strUrl) {
		header("Location {$strUrl}");
	}

	public function outputJson($mxdContent) {
		header('Cache-Control: no-cache, must-revalidate');
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($mxdContent);
	}

}