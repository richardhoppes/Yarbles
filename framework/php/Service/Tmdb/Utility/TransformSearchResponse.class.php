<?
class Service_Tmdb_Utility_TransformSearchResponse {

    public static function transformSearchMovieResponse($objResponse) {
        $objSearchMovie = new Service_Tmdb_Entity_SearchMovie();

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
}
?>