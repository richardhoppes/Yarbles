<?
class Api_Tmdb_Utility_TransformSearchResponse {

	public static function transformSearchMovieResponse($objResponse) {
		$objSearchMovie = new Api_Tmdb_Entity_SearchMovie();

		if($objResponse != null && is_object($objResponse)) {
			$objSearchMovie->setAdult($objResponse->adult);
			$objSearchMovie->setBackdropPath($objResponse->backdrop_path);
			$objSearchMovie->setId($objResponse->id);
			$objSearchMovie->setOriginalTitle($objResponse->original_title);
			$objSearchMovie->setReleaseDate($objResponse->release_date);
			$objSearchMovie->setPosterPath($objResponse->poster_path);
			$objSearchMovie->setPopularity($objResponse->popularity);
			$objSearchMovie->setTitle($objResponse->title);
			$objSearchMovie->setVoteAverage($objResponse->vote_average);
			$objSearchMovie->setVoteCount($objResponse->vote_count);
		}

		return $objSearchMovie;
	}

	public static function transformSearchPersonResponse($objResponse) {
		$objSearchPerson = new Api_Tmdb_Entity_SearchPerson();

		if($objResponse != null && is_object($objResponse)) {
			$objSearchPerson->setAdult($objResponse->adult);
			$objSearchPerson->setProfilePath($objResponse->profile_path);
			$objSearchPerson->setId($objResponse->id);
			$objSearchPerson->setName($objResponse->name);
		}

		return $objSearchPerson;
	}

	public static function transformSearchCompanyResponse($objResponse) {
		$objSearchCompany = new Api_Tmdb_Entity_SearchCompany();

		if($objResponse != null && is_object($objResponse)) {
			$objSearchCompany->setLogoPath($objResponse->logo_path);
			$objSearchCompany->setId($objResponse->id);
			$objSearchCompany->setName($objResponse->name);
		}

		return $objSearchCompany;
	}
}
?>