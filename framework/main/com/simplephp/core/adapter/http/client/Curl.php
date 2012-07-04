<?
namespace com\simplephp\core\adapter\http\client;

use com\simplephp\core\adapter\http\client\HttpClientAdapterInterface;

class Curl implements HttpClientAdapterInterface {

	private $objConfig;

	public function __construct(ConfigInterface $objConfig) {
		$this->objConfig = $objConfig;
	}

	public function connect($strHost, $intPort = 80, $boolSecure = false) {
		// TODO: Implement connect() method.
	}

	public function write($strMethod, $strUrl, $httpVersion = '1.1', $arrHeaders = array(), $strbody = '') {
		// TODO: Implement write() method.
	}

	public function read() {
		// TODO: Implement read() method.
	}

	public function close() {
		// TODO: Implement close() method.
	}
}