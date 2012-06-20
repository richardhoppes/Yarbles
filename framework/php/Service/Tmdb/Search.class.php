<?php

class Service_Tmdb_Search extends Service_Tmdb {

    const SEARCH_MOVIE_METHOD = 'search/movie';
    const SEARCH_PERSON_METHOD = 'search/person';
    const SEARCH_COMPANY_METHOD = 'search/company';

    public function searchMovie($strQuery, $intPage = null) {
        return $this->search(self::SEARCH_MOVIE_METHOD, $strQuery, $intPage, true);
    }

    public function searchPerson($strQuery, $intPage = null) {
        return $this->search(self::SEARCH_PERSON_METHOD, $strQuery, $intPage, true);
    }

    public function searchCompany($strQuery, $intPage = null) {
        return $this->search(self::SEARCH_COMPANY_METHOD, $strQuery, $intPage);
    }

    protected function search($strMethod, $strQuery, $intPage = null, $boolAdult = false) {
        $strUrl = $this->buildGetURL($strMethod, $strQuery, $intPage, $boolAdult);
        $strResult = $this->objHttpClient->getResource($strUrl);
        return $this->parseResponse($strResult, $strMethod);
    }

    protected function buildGetURL($strMethod, $strQuery, $intPage = null, $boolIncludeAdult = false) {
        $strUrl = self::BASE_API_URL . $strMethod;
        $strUrl .= "?api_key={$this->strApiKey}";
        $strUrl .= "&query=" . urlencode($strQuery);

        if($intPage != null) {
            $strUrl .= "&page={$intPage}";
        }

        if($boolIncludeAdult) {
            $strUrl .= "&include_adult=true";
        }

        return $strUrl;
    }

    protected function parseResponse($strResponse, $strMethod) {
        $objReturn = new Service_Tmdb_Entity_SearchResponse();

        $objParsedResponse = json_decode($strResponse);
        if( isset($objParsedResponse->total_results) && (int) $objParsedResponse->total_results > 0 ) {
            $objReturn->setPage($objParsedResponse->page);
            $objReturn->setTotalPages($objParsedResponse->total_pages);
            $objReturn->setTotalResults($objParsedResponse->total_results);

            $arrResults = array();
            foreach($objParsedResponse->results as $objResponse) {
                switch($strMethod) {
                    case self::SEARCH_MOVIE_METHOD:
                        $arrResults[] = Service_Tmdb_Utility_TransformSearchResponse::transformSearchMovieResponse($objResponse);
                        break;
                    case self::SEARCH_PERSON_METHOD:
                        $arrResults[] = Service_Tmdb_Utility_TransformSearchResponse::transformSearchPersonResponse($objResponse);
                        break;
                    case self::SEARCH_COMPANY_METHOD:
                        $arrResults[] = Service_Tmdb_Utility_TransformSearchResponse::transformSearchCompanyResponse($objResponse);
                        break;
                }
            }
            $objReturn->setResults($arrResults);
        }

        return $objReturn;
    }
}
