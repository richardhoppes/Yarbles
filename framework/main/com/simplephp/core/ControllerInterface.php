<?
namespace com\simplephp\core;

interface ControllerInterface {

	public function loadView($strView, $arrParams = array());

	public function redirect($strUrl);

}