<?
namespace yarbles\framework;

interface ControllerInterface {

	public function loadView($strView, $arrParams = array());

	public function redirect($strUrl);

	public function outputJson($mxdContent);

}