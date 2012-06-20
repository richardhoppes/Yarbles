<?php

class Service_Tmdb_Movie extends Service_Tmdb
{
	/**
	 * Valid movie methods
	 */
	const MOVIE_SEARCH_METHOD = 'Movie.search';
	const MOVIE_IMDB_LOOKUP_METHOD = 'Movie.imdbLookup';
	const MOVIE_GET_VERSION_METHOD = 'Movie.getVersion';
	const MOVIE_GET_TRANSLATIONS_METHOD = 'Movie.getTranslations';
	const MOVIE_GET_LATEST_METHOD = 'Movie.getLatest';
	const MOVIE_GET_INFO_METHOD = 'Movie.getInfo';
	const MOVIE_GET_IMAGES_METHOD = 'Movie.getImages';
	const MOVIE_BROWSE_METHOD = 'Movie.browse';
	const MOVIE_ADD_RATING_METHOD = 'Movie.addRating';

	/**
	 * Search for title
	 * @param $strName movie/tv show name
	 * @return array
	 */
	public function movieSearch($strName) {
		$arrResults = $this->doGet(self::MOVIE_SEARCH_METHOD, urlencode($strName));
		$arrEntries = array();
		foreach($arrResults as $intMovieIndex => $arrMovie) {
			$arrEntries[] = Service_Tmdb_Utility_Movie::createMovieSearch($arrMovie);
		}
		return $arrEntries;
	}

	/**
	 * Browse tmdb catalog
	 * @param string $strOrder (asc, desc)
	 * @param string $strOrderBy (title, release, rating)
	 * @param int $intPerPage number of results per page
	 * @param int $intPage current page
	 * @param string $strQuery fuzzy title search
	 * @param int $intMinVotes minimum number of votes (int value)
	 * @param float $intRatingMin maximum rating (float)
	 * @param float $intRatingMax minimum rating (float)
	 * @param string $strGenres comma separated genre ids
	 * @param string $strGenresSelector (and, or)
	 * @param int $intReleaseMin minimum release date (epoch)
	 * @param int $intReleaseMax maximum release date (epoch)
	 * @param string $strYear (4 digit integer)
	 * @param string $strCertifications comma separated list of MPAA ratings (e.g. PG,PG-13) (assumed to be an 'or' search
	 * @param string $strCompanies comma separated list of company ids (assumed to be an 'or' search)
	 * @param string $strCountries comma separated list of two-letter country codes (assumed to be an 'or' search)
	 * @return array
	 */
	public function browse($strOrder = "asc", $strOrderBy = "title", $intPerPage = 30, $intPage = 1, $strQuery = null,
		$intMinVotes = -1, $floatRatingMin = -1, $floatRatingMax = -1, $strGenres = null, $strGenresSelector = "and", $intReleaseMin = 0,
		$intReleaseMax = 0, $strYear = null, $strCertifications = null, $strCompanies = null, $strCountries = null
	) {
		if($strOrder != 'asc' && $strOrder != 'desc')
			$strOrder = 'asc';

		if($strOrderBy != 'title' && $strOrderBy != 'release' && $strOrderBy != 'rating')
			$strOrderBy = 'title';

		$strQueryString = "?order={$strOrder}";
		$strQueryString .= "&order_by={$strOrderBy}";
		$strQueryString .= "&per_page={$intPerPage}";
		$strQueryString .= "&page={$intPage}";

		if($strQuery != null)
			$strQueryString .= "&query=" . urlencode($strQuery);

		if($intMinVotes != -1)
			$strQueryString .= "&min_votes={$intMinVotes}";

		if($floatRatingMin != -1)
			$strQueryString .= "&rating_min={$floatRatingMin}";

		if($floatRatingMax != -1)
			$strQueryString .= "&rating_max={$floatRatingMax}";

		if($strGenres != null)
			$strQueryString .= "&genres={$strGenres}";

		if($strGenres != null && $strGenresSelector != null && ($strGenresSelector == 'and' || $strGenresSelector == 'or'))
			$strQueryString .= "&genres_selector={$strGenresSelector}";

		if($intReleaseMin != 0 && $intReleaseMax != 0) {
			$strQueryString .= "&release_min={$intReleaseMin}";
			$strQueryString .= "&release_max={$intReleaseMax}";
		}

		if($strYear != null)
			$strQueryString .= "&year={$strYear}";

		if($strCertifications != null)
			$strQueryString .= "&certifications={$strCertifications}";

		if($strCompanies != null)
			$strQueryString .= "&companies={$strCompanies}";

		if($strCountries != null)
			$strQueryString .= "&countries={$strCountries}";

		$arrResults = $this->doGet(self::MOVIE_BROWSE_METHOD, $strQueryString);

		$arrEntries = array();
		foreach($arrResults as $intMovieIndex => $arrMovie) {
			$arrEntries[] = Service_Tmdb_Utility_Movie::createMovieBrowse($arrMovie);
		}
		return $arrEntries;
	}

}
