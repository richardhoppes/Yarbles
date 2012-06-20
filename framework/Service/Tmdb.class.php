<?php

abstract class Service_Tmdb {

    /**
     * Valid response formats
     */
    const FORMAT_JSON = 'json';

    /**
     * Base API URL
     */
    const BASE_API_URL = 'http://api.themoviedb.org/2.1/';

    /**
     * @var string Response format
     */
    protected $strFormat;

    /**
     * @var string Response language
     */
    protected $strLanguage;

    /**
     * @var string
     */
    protected $strApiKey;

    /**
     * @var Client_Http
     */
    protected $objHttpClient;

    public function __construct() {
        $objConfig = Config::getHandle();
        $this->strFormat = $objConfig->TMDB_FORMAT;
        $this->strLanguage = $objConfig->TMDB_LANGUAGE;
        $this->strApiKey = $objConfig->TMDB_API_KEY;

        $this->objHttpClient = new Client_Http();
    }

    /**
     * Perform get operation, return result
     * @param $method
     * @param $args
     * @param bool $includeLanguage some requests do not require passing the language as part of the url
     * @param bool $includeFormat some requests do not require passing the format as part of the url
     * @return mixed
     * @throws Exception
     */
    protected function doGet($strMethod, $arrArgs, $boolIncludeLanguage = true, $boolIncludeFormat = true) {
        $strUri = $this->buildGetURL($strMethod, $arrArgs, $boolIncludeLanguage, $boolIncludeFormat);
        $strResponse = $this->objHttpClient->getResource($strUri);

        if(!$strResponse)
            throw new Exception("Error performing get operation");

        return $this->parseResponse($strResponse);
    }

    /**
     * Parse response
     * @param $responseBody
     * @return mixed
     * @throws Exception
     */
    protected function parseResponse($strResponse) {
        switch($this->strFormat) {
            case self::FORMAT_JSON:
                $strParsedResponse = json_decode($strResponse);
                if(!$strParsedResponse)
                    throw new Exception("Invalid JSON response");
                break;
            default:
                throw new Exception("Unsupported response type: " . $this->strFormat);
                break;
        }
        return $strParsedResponse;
    }

    /**
     * Build url for get requests
     * @param String $method API method to call
     * @param String $args
     * @param bool $includeLanguage include language in URL
     * @param bool $includeFormat include format in URL
     * @return String
     */
    private function buildGetURL($strMethod, $arrArgs, $boolIncludeLanguage, $boolIncludeFormat) {
        $strUrl = self::BASE_API_URL . $strMethod;

        if($boolIncludeLanguage) {
            $strUrl .= "/" . $this->strLanguage;
        }
        if($boolIncludeFormat) {
            $strUrl .= '/' . $this->strFormat;
        }

        $strUrl .= '/' . $this->strApiKey;

        return $this->appendArgs($strUrl, $arrArgs);
    }

    /**
     * Appends arguments to request url
     * @param String $url
     * @param String $args
     * @return String
     */
    private function appendArgs($strUrl, $arrArgs) {
        if($arrArgs != null && strlen($arrArgs) > 0) {
            if(substr($arrArgs, 0, 1) == '?')
                $strUrl .= $arrArgs;
            else
                $strUrl .= '/' . $arrArgs;
        }
        return $strUrl;
    }

}
