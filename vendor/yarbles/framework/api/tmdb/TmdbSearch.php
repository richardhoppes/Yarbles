<?php
namespace yarbles\framework\api\tmdb;

use yarbles\framework\api\tmdb\Tmdb;
use yarbles\framework\api\tmdb\entity\SearchResponse;
use yarbles\framework\api\tmdb\utility\TransformSearchResponse;

/**
 * Tmdb API search class
 * @author Richard Hoppes
 */
class TmdbSearch extends Tmdb {

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

	protected function search($strMethod, $strQuery, $intPage = null, $boolAdult = true) {
	    $strUrl = $this->buildGetURL($strMethod, $strQuery, $intPage, $boolAdult);
	    $this->objRestService->restGet($strUrl);
	    return $this->parseResponse($this->objRestService->getResponse(), $strMethod);
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
		$objReturn = new SearchResponse();

		$objParsedResponse = json_decode($strResponse);
		if( isset($objParsedResponse->total_results) && (int) $objParsedResponse->total_results > 0 ) {
			$objReturn->setPage($objParsedResponse->page);
			$objReturn->setTotalPages($objParsedResponse->total_pages);
			$objReturn->setTotalResults($objParsedResponse->total_results);

			$arrResults = array();
			foreach($objParsedResponse->results as $objResponse) {
				switch($strMethod) {
					case self::SEARCH_MOVIE_METHOD:
						$arrResults[] = TransformSearchresponse::transformSearchMovieResponse($objResponse);
						break;
					case self::SEARCH_PERSON_METHOD:
						$arrResults[] = TransformSearchresponse::transformSearchPersonResponse($objResponse);
						break;
					case self::SEARCH_COMPANY_METHOD:
						$arrResults[] = TransformSearchresponse::transformSearchCompanyResponse($objResponse);
						break;
				}
			}
			$objReturn->setResults($arrResults);
		}

	    return $objReturn;
    }
}