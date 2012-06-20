<?php
class Client_Http {

    /**
     * Post resource
     * @param $strUrl
     * @param string $strVars
     * @return mixed
     */
    public function postResource($strUrl, $strVars = '') {
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

    /**
     * Get resource
     * @param $strUrl
     * @return mixed
     */
    public function getResource($strUrl) {
        $hCurl = curl_init();
        curl_setopt($hCurl, CURLOPT_URL, $strUrl);
        curl_setopt($hCurl, CURLOPT_HEADER, false);
        curl_setopt($hCurl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($hCurl, CURLOPT_RETURNTRANSFER, 1);
        $strData = curl_exec($hCurl);
        curl_close($hCurl);

        return $strData;
    }

    /**
     * Delete resource
     * @param $strUrl
     * @return mixed
     */
    public function deleteResource($strUrl) {
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
}