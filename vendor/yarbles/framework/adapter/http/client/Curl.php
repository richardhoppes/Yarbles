<?
namespace yarbles\framework\adapter\http\client;

use yarbles\framework\adapter\http\client\HttpClientAdapterInterface;
use yarbles\framework\common\YarblesLocator;
use yarbles\framework\exception\http\NoConnectionException;
use yarbles\framework\exception\http\UnsupportedRequestTypeException;
use yarbles\framework\exception\http\StreamingRequestException;
use yarbles\framework\exception\http\UnsupportedHttpVersionException;
use yarbles\framework\exception\http\RequestException;

/**
 * Curl adapter
 * @author Richard Hoppes
 */
class Curl implements HttpClientAdapterInterface {
	
	protected $objConfig;
	protected $resCurl;
	protected $strRequest;
	protected $strResponseContent;
	protected $strResponseHeader;
	protected $intConnectedPort;
	protected $strConnectedHost;

	public function __construct() {
		$this->objConfig = YarblesLocator::getConfig();
	}

	/**
	 * Connect to server
	 */
	public function connect($strHost, $intPort = 80, $boolSecure = false, $intTimeout = null, $intMaxRedirects = null) {
		if($this->resCurl) {
			$this->close();
		}

		$this->resCurl = curl_init();

		curl_setopt($this->resCurl, CURLOPT_PORT, (int) $intPort);

		if($intMaxRedirects == null) {
			$intMaxRedirects = $this->objConfig->getProperty('curl_default_max_redirects');
		}

		if($intMaxRedirects == 0) {
			curl_setopt($this->resCurl, CURLOPT_FOLLOWLOCATION, false);
		} else {
			curl_setopt($this->resCurl, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($this->resCurl, CURLOPT_MAXREDIRS, (int) $intMaxRedirects);
		}

		if($boolSecure) {
			if($this->objConfig->getProperty('curl_ssl_cert') != null) {
				curl_setopt($this->resCurl, CURLOPT_SSLCERT, $this->objConfig->getProperty('curl_ssl_cert'));
			}
			if($this->objConfig->getProperty('curl_ssl_passphrase') != null) {
				curl_setopt($this->resCurl, CURLOPT_SSLCERTPASSWD, $this->objConfig->getProperty('curl_ssl_passphrase'));
			}
		}

		if(!$this->resCurl) {
			$this->close();
			throw new NoConnectionException();
		}

		$this->strConnectedHost = $strHost;
		$this->intConnectedPort = $intPort;
	}

	public function request($strMethod, $strUrl, $strHttpVersion = self::HTTP_VERSION_1_1, $arrHeaders = array(), $mxdBody = '') {

		if(!$this->resCurl) {
			throw new NoConnectionException();
		}

		$this->clear();

		// URL
		// TODO: Verify that hosts/ports match, otherwise throw exception
		curl_setopt($this->resCurl, CURLOPT_URL, $strUrl);

		// Request method
		switch($strMethod) {
			case self::METHOD_GET:
				curl_setopt($this->resCurl, CURLOPT_HTTPGET, true);
				break;
			case self::METHOD_POST:
				curl_setopt($this->resCurl, CURLOPT_POST, true);
				break;
			case self::METHOD_DELETE: 
				curl_setopt($this->resCurl, CURLOPT_CUSTOMREQUEST, "DELETE");
				break;
			case self::METHOD_PUT:
				// TODO: Also handle file uploads
				if(is_resource($mxdBody)) {
					throw new Exception("Streaming requests are not yet supported");
				} 
				curl_setopt($this->resCurl, CURLOPT_CUSTOMREQUEST, "PUT");
				break;
			default: 
			    throw new UnsupportedRequestTypeException($strMethod);
		}
		if(is_resource($mxdBody) && $strMethod != self::METHOD_PUT) {
			throw new StreamingRequestException();
		}

		// HTTP Version
		switch($strHttpVersion) {
			case self::HTTP_VERSION_1_1:
				curl_setopt($this->resCurl, CURL_HTTP_VERSION_1_1, true);
				break;
			case self::HTTP_VERSION_1_0:
				curl_setopt($this->resCurl, CURL_HTTP_VERSION_1_0, true);
				break;
			default:
				throw new UnsupportedHttpVersionException($strHttpVersion);
		}

		// Get headers
		curl_setopt($this->resCurl, CURLOPT_HEADER, true);

		// Get response
		curl_setopt($this->resCurl, CURLOPT_RETURNTRANSFER, true);

		// Basic authorization
		if(array_key_exists('Authorization', $arrHeaders) && 'Basic' == substr($arrHeaders['Authorization'], 0, 5)) {
			curl_setopt($this->resCurl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($this->resCurl, CURLOPT_USERPWD, base64_decode(substr($arrHeaders['Authorization'], 6)));
			unset($arrHeaders['Authorization']);
		}

		// Format headers for request
		$arrFormattedHeaders = array();
		foreach ($arrHeaders as $key => $value) {
			$arrFormattedHeaders[] = $key . ': ' . $value;
		}
		curl_setopt($this->resCurl, CURLOPT_HTTPHEADER, $arrFormattedHeaders);

		// Post fields
		if ($strMethod == self::METHOD_POST || $strMethod == self::METHOD_PUT) {
			curl_setopt($this->resCurl, CURLOPT_POSTFIELDS, $mxdBody);
		}

		// TODO: Option to set additional CURL options

	    // send the request
	    $strResponse = curl_exec($this->resCurl);

		// Split header and content
		$arrResponse = explode("\r\n\r\n", $strResponse);
		$this->strResponseHeader = $arrResponse[0];
		$this->strResponseContent = $arrResponse[1];

	    $this->strRequest = curl_getinfo($this->resCurl, CURLINFO_HEADER_OUT);

//		if (empty($this->strResponseHeader) || empty($this->strResponseContent)) {
//			throw new RequestException(curl_error($this->resCurl));
//		}

	    return $this->strRequest;
	}

	/**
	 * Return response content
	 */
	public function getResponse() {
		return $this->strResponseContent;
	}

	/**
	 * Return response header
	 */
	public function getResponseHeader() {
		return $this->strResponseHeader;
	}

	/**
	 * Return request
	 */
	public function getRequest() {
		return $this->strRequest;
	}

	/**
	 * Clear request/response variables
	 */
	private function clear() {
		$this->strRequest = null;
		$this->strResponseContent = null;
		$this->strResponseHeader = null;
	}

	/**
	 * Close server connection
	 */
	public function close() {
		if (is_resource($this->resCurl)) {
			curl_close($this->resCurl);
		}
		$this->resCurl = null;
		$this->strConnectedHost = null;
		$this->intConnectedPort = null;
	}
}