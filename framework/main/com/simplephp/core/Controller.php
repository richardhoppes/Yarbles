<?php
namespace com\simplephp\core;

use com\simplephp\web\common\ServiceLocator;

use com\simplephp\core\ControllerInterface;
use com\simplephp\core\exception\view\ViewNotFoundException;

/**
 * Abstract controller class
 * @author Richard Hoppes
 */
abstract class Controller implements ControllerInterface {

	protected $objConfig;

	public function __construct() {
		$this->objConfig = ServiceLocator::getConfig();
	}

	public function loadView($strView, $arrParams = array()) {
		// Look for application view first
		if(file_exists($this->objConfig->getProperty("app_web_view_path") . '/' . str_replace('_', '/', $strView ) . ".php")) {
			include_once($this->objConfig->getProperty("app_web_view_path") . '/' . str_replace('_', '/', $strView ) . ".php");
		// Fall back to framework view
		} elseif(file_exists($this->objConfig->getProperty("fw_core_view_path") . '/' . str_replace('_', '/', $strView ) . ".php")) {
			include_once($this->objConfig->getProperty("fw_core_view_path") . '/' . str_replace('_', '/', $strView ) . ".php");
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
		header('Content-type: application/json');
		echo json_encode($mxdContent);
	}

}