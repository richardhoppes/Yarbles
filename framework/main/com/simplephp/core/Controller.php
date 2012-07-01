<?php
namespace com\simplephp\core;

use com\simplephp\core\ControllerInterface;
use com\simplephp\core\exception\view\ViewNotFoundException;
use com\simplephp\core\ConfigInterface;

/**
 * Abstract controller class
 * @author Richard Hoppes
 */
abstract class Controller implements ControllerInterface {

	protected $objConfig;

	public function __construct(ConfigInterface $objConfig) {
		$this->objConfig = $objConfig;
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

}