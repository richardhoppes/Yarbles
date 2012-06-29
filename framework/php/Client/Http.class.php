<?php

class Client_Http {

	public function post($strUrl, $strVars = '') {
		$hCurl = curl_init();
		curl_setopt($hCurl, CURLOPT_URL, $strUrl);
		curl_setopt($hCurl, CURLOPT_HEADER, false);
		curl_setopt($hCurl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($hCurl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($hCurl, CURLOPT_POST, 1);
		curl_setopt($hCurl, CURLOPT_POSTFIELDS, $strVars);
		$strData = curl_exec($hCurl);
		curl_close($hCurl);
		return $strData;
	}

	public function get($strUrl) {
		$hCurl = curl_init();
		curl_setopt($hCurl, CURLOPT_URL, $strUrl);
		curl_setopt($hCurl, CURLOPT_HEADER, false);
		curl_setopt($hCurl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($hCurl, CURLOPT_RETURNTRANSFER, 1);
		$strData = curl_exec($hCurl);
		curl_close($hCurl);
		return $strData;
	}

	public function delete($strUrl) {
		$hCurl = curl_init();
		curl_setopt($hCurl, CURLOPT_URL, $strUrl);
		curl_setopt($hCurl, CURLOPT_HEADER, false);
		curl_setopt($hCurl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($hCurl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($hCurl, CURLOPT_CUSTOMREQUEST, "DELETE");
		$strData = curl_exec($hCurl);
		curl_close($hCurl);
		return $strData;
	}

	public function put($strUrl) {
		$hCurl = curl_init();
		curl_setopt($hCurl, CURLOPT_URL, $strUrl);
		curl_setopt($hCurl, CURLOPT_HEADER, false);
		curl_setopt($hCurl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($hCurl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($hCurl, CURLOPT_CUSTOMREQUEST, "PUT");
		$strData = curl_exec($hCurl);
		curl_close($hCurl);
		return $strData;
	}
}