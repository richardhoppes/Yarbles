<?
namespace com\simplephp\core\service;

class RestService {

	protected $objHttpClientAdapter;

	protected $objConfig;

	public function __construct(ConfigInterface $objConfig, HttpClientAdapterInterface $objHttpClientAdapter) {
		$this->objHttpClientAdapter = $objHttpClientAdapter;
	}

	protected function httpPost() {
		return null; // TODO: Implement
	}

	public function restGet($strUrl, $arrGetParameters = array()) {
		return null; // TODO: Implement
	}

	public function restPost($strUrl, $strData = null) {
		return null; // TODO: Implement
	}

	public function restPut($strUrl, $strData = null) {
		return null; // TODO: Implement
	}

	public function restDelete($strUrl, $strData = null) {
		return null; // TODO: Implement
	}

}