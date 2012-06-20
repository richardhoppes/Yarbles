<?php

class Service_Tmdb_Utility_Movie {

	public function createMovie($movie, $newMovie = null) {

		if($newMovie == null)
			$newMovie = new Service_Tmdb_Entity_Movie();

		if(isset($movie->alternative_name))
			$newMovie->setAlternativeName(trim($movie->alternative_name));

		if(isset($movie->certification))
			$newMovie->setCertification(trim($movie->certification));

		if(isset($movie->popularity))
			$newMovie->setPopularity($movie->popularity);

		if(isset($movie->translated))
			$newMovie->setTranslated($movie->translated);

		if(isset($movie->language))
			$newMovie->setLanguage(trim($movie->language));

		if(isset($movie->original_name))
			$newMovie->setOriginalName(trim($movie->original_name));

		if(isset($movie->name))
			$newMovie->setName(trim($movie->name));

		if(isset($movie->movie_type))
			$newMovie->setMovieType(trim($movie->movie_type));

		if(isset($movie->id))
			$newMovie->setId($movie->id);

		if(isset($movie->imdb_id))
			$newMovie->setImdbId(trim($movie->imdb_id));

		if(isset($movie->url))
			$newMovie->setUrl($movie->url);

		if(isset($movie->overview))
			$newMovie->setOverview(trim($movie->overview));

		if(isset($movie->votes))
			$newMovie->setVotes($movie->votes);

		if(isset($movie->rating))
			$newMovie->setRating($movie->rating);

		if(isset($movie->released))
			$newMovie->setReleaseDate($movie->released);

		if(isset($movie->version))
			$newMovie->setVersion($movie->version);

		if(isset($movie->last_modified_at))
			$newMovie->setLastModifiedAt($movie->last_modified_at);

		if(isset($movie->rating))
			$newMovie->setRating($movie->rating);

		if(isset($movie->adult))
			$newMovie->setAdult($movie->adult);

		if(isset($movie->score))
			$newMovie->setScore($movie->score);

		$images = array();
		if(isset($movie->posters)) {
			foreach($movie->posters as $posterIndex => $poster) {
				$image = new Service_Tmdb_Entity_Image();
				$image->setType($poster->image->type);
				$image->setSize($poster->image->size);
				$image->setHeight($poster->image->height);
				$image->setWidth($poster->image->width);
				$image->setUrl($poster->image->url);
				$image->setId($poster->image->id);
				$images[] = $image;
			}
		}
		if(isset($movie->backdrops)) {
			foreach($movie->backdrops as $backdropIndex => $backdrop) {
				$image = new Service_Tmdb_Entity_Image();
				$image->setType($backdrop->image->type);
				$image->setSize($backdrop->image->size);
				$image->setHeight($backdrop->image->height);
				$image->setWidth($backdrop->image->width);
				$image->setUrl($backdrop->image->url);
				$image->setId($backdrop->image->id);
				$images[] = $image;
			}
		}
		$newMovie->setImages($images);

		return $newMovie;
	}

	public static function createMovieBrowse($movie) {
		$newMovie = new Service_Tmdb_Entity_MovieBrowse();
		$newMovie = self::createMovie($movie, $newMovie);

		if(isset($movie->adult))
			$newMovie->setAdult($movie->adult);

		if(isset($movie->score))
			$newMovie->setScore($movie->score);

		if(isset($movie->runtime))
			$newMovie->setRuntime($movie->runtime);

		return $newMovie;
	}

	public static function createMovieSearch($movie) {
		$newMovie = new Service_Tmdb_Entity_MovieSearch();
		$newMovie = self::createMovie($movie, $newMovie);

		if(isset($movie->score))
			$newMovie->setScore($movie->score);

		return $newMovie;
	}

}