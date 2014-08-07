<?
namespace yarbles\framework\service;

use yarbles\framework\adapter\http\client\HttpClientAdapterInterface;

interface RestServiceInterface {

	public function restGet($strUrl);

	public function restPost($strUrl, $strData = null);

	public function restPut($strUrl, $strData = null);

	public function restDelete($strUrl, $strData = null);

	public function getResponseHeader();

	public function getResponse();

	public function getRequest();

}