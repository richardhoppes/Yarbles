<?php
/**
 * Abstract controller class
 * @author Richard Hoppes
 */
abstract class Controller {
	public function __construct() {
		// Do something
	}

	public function loadView($strView, $arrParams = array()) {

		$objConfig = Config::getHandle();

		// Make sure session is loaded before displaying view
		$objSession = Session::getHandle();

		// Look for application view first
		if(file_exists($objConfig->APP_VIEW_PATH . '/' . str_replace('_', '/', $strView ) . ".php"))
			include_once($objConfig->APP_VIEW_PATH . '/' . str_replace('_', '/', $strView ) . ".php");

		// Fall back to framework view
		elseif(file_exists($objConfig->FW_VIEW_PATH . '/' . str_replace('_', '/', $strView ) . ".php"))
			include_once($objConfig->FW_VIEW_PATH . '/' . str_replace('_', '/', $strView ) . ".php");

		// If no view exists, throw exception
		else
			throw new Exception_View_ViewNotFound($strView);
	}

	public function redirect($strUrl) {
		header("Location {$strUrl}");
	}

	abstract public function main();
}