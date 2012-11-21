<?
namespace yarbles\framework\service;

use yarbles\framework\adapter\http\client\HttpClientAdapterInterface;

/**
 * Rest service for RESTful API requests
 * @author Richard Hoppes
 */
class RestService {

	protected $objHttpClientAdapter;
	protected $objConfig;
	protected $strHost;
	protected $intPort;
	protected $strResponseHeader;
	protected $strResponseContent;
	protected $strRequest;

	public function __construct(HttpClientAdapterInterface $objHttpClientAdapter, $strHost, $intPort) {
		$this->strHost = $strHost;
		$this->intPort = $intPort;
		$this->objHttpClientAdapter = $objHttpClientAdapter;
	}

	protected function httpPost($strMethod, $strUrl, $strData) {
		$this->objHttpClientAdapter->connect($this->strHost, $this->intPort, 60, 3);
		$this->objHttpClientAdapter->request($strMethod, $strUrl, HttpClientAdapterInterface::HTTP_VERSION_1_1, array(), $strData);
		$this->objHttpClientAdapter->close();
		
		$this->strResponseContent = $this->objHttpClientAdapter->getResponse();
		$this->strResponseHeader = $this->objHttpClientAdapter->getResponseHeader();
		$this->strRequest = $this->objHttpClientAdapter->getRequest();
		return $this->strRequest;
	}

	protected function httpGet($strUrl) {
		$this->objHttpClientAdapter->connect($this->strHost, $this->intPort, 60, 3);
		$this->objHttpClientAdapter->request(HttpClientAdapterInterface::METHOD_GET, $strUrl);
		$this->objHttpClientAdapter->close();

		$this->strResponseContent = $this->objHttpClientAdapter->getResponse();
		$this->strResponseHeader = $this->objHttpClientAdapter->getResponseHeader();
		$this->strRequest = $this->objHttpClientAdapter->getRequest();
		return $this->strRequest;
	}

	public function restGet($strUrl) {
		return $this->httpGet($strUrl);
	}

	public function restPost($strUrl, $strData = null) {
		return $this->httpPost(HttpClientAdapterInterface::METHOD_POST, $strUrl, $strData);
	}

	public function restPut($strUrl, $strData = null) {
		return $this->httpPost(HttpClientAdapterInterface::METHOD_PUT, $strUrl, $strData);
	}

	public function restDelete($strUrl, $strData = null) {
		return $this->httpPost(HttpClientAdapterInterface::METHOD_DELETE, $strUrl, $strData);
	}

	public function getResponseHeader() {
		return $this->strResponseHeader;
	}

	public function getResponse() {
		return $this->strResponseContent;
	}

	public function getRequest() {
		return $this->strRequest;
	}

}