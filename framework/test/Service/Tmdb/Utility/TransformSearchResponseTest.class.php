<?php
class TransformSearchResponseTest extends UnitTestCase {

    function testTransformSearchMovieResult() {
        $objResponse = new stdClass();
        $objResponse->adult = true;
        $objResponse->backdrop_path = "/test_backdrop_path.jpg";
        $objResponse->id = 290;
        $objResponse->original_title = "Test Original Title";
        $objResponse->release_date = "1980-05-21";
        $objResponse->poster_path = "/test_poster_path.jpg";
        $objResponse->popularity = 9000.123;
        $objResponse->title = "Test Title";
        $objResponse->vote_average = 9;
        $objResponse->vote_count = 10;

        $objSearchMovie = Api_Tmdb_Utility_TransformSearchResponse::transformSearchMovieResponse($objResponse);

        $this->assertEqual($objSearchMovie->getAdult(), $objResponse->adult ? 1 : 0);
        $this->assertEqual($objSearchMovie->getBackdropPath(), $objResponse->backdrop_path);
        $this->assertEqual($objSearchMovie->getId(), $objResponse->id);
        $this->assertEqual($objSearchMovie->getOriginalTitle(), $objResponse->original_title);
        $this->assertEqual($objSearchMovie->getReleaseDate(), strtotime($objResponse->release_date));
        $this->assertEqual($objSearchMovie->getPosterPath(), $objResponse->poster_path);
        $this->assertEqual($objSearchMovie->getPopularity(), $objResponse->popularity);
        $this->assertEqual($objSearchMovie->getTitle(), $objResponse->title);
        $this->assertEqual($objSearchMovie->getVoteAverage(), $objResponse->vote_average);
        $this->assertEqual($objSearchMovie->getVoteCount(), $objResponse->vote_count);
    }

    function testTransformSearchMovieResult_NullResult() {
        $objSearchMovie = Api_Tmdb_Utility_TransformSearchResponse::transformSearchMovieResponse(null);

        $this->assertEqual($objSearchMovie->getAdult(), false);
        $this->assertEqual($objSearchMovie->getBackdropPath(), null);
        $this->assertEqual($objSearchMovie->getId(), 0);
        $this->assertEqual($objSearchMovie->getOriginalTitle(), null);
        $this->assertEqual($objSearchMovie->getReleaseDate(), null);
        $this->assertEqual($objSearchMovie->getPosterPath(), null);
        $this->assertEqual($objSearchMovie->getPopularity(), 0.0);
        $this->assertEqual($objSearchMovie->getTitle(), null);
        $this->assertEqual($objSearchMovie->getVoteAverage(), 0);
        $this->assertEqual($objSearchMovie->getVoteCount(), 0);
    }

    function testTransformSearchPersonResult() {
        $objResponse = new stdClass();
        $objResponse->adult = true;
        $objResponse->profile_path = "/test_person_path.jpg";
        $objResponse->id = 3000;
        $objResponse->name = "Person Name";

        $objSearchPerson = Api_Tmdb_Utility_TransformSearchResponse::transformSearchPersonResponse($objResponse);

        $this->assertEqual($objSearchPerson->getAdult(), $objResponse->adult ? 1 : 0);
        $this->assertEqual($objSearchPerson->getProfilePath(), $objResponse->profile_path);
        $this->assertEqual($objSearchPerson->getId(), $objResponse->id);
        $this->assertEqual($objSearchPerson->getName(), $objResponse->name);
    }

    function testTransformSearchPersonResult_NullResult() {
        $objSearchPerson = Api_Tmdb_Utility_TransformSearchResponse::transformSearchPersonResponse(null);

        $this->assertEqual($objSearchPerson->getAdult(), false);
        $this->assertEqual($objSearchPerson->getProfilePath(), null);
        $this->assertEqual($objSearchPerson->getId(), 0);
        $this->assertEqual($objSearchPerson->getName(), null);
    }

    function testTransformSearchCompanyResult() {
        $objResponse = new stdClass();
        $objResponse->logo_path = "/test_logo_path.jpg";
        $objResponse->id = 200;
        $objResponse->name = "Company Name";

        $objSearchCompany = Api_Tmdb_Utility_TransformSearchResponse::transformSearchCompanyResponse($objResponse);

        $this->assertEqual($objSearchCompany->getLogoPath(), $objResponse->logo_path);
        $this->assertEqual($objSearchCompany->getId(), $objResponse->id);
        $this->assertEqual($objSearchCompany->getName(), $objResponse->name);
    }

    function testTransformSearchCompanyResult_NullResult() {
        $objSearchCompany = Api_Tmdb_Utility_TransformSearchResponse::transformSearchCompanyResponse(null);

        $this->assertEqual($objSearchCompany->getLogoPath(), null);
        $this->assertEqual($objSearchCompany->getId(), 0);
        $this->assertEqual($objSearchCompany->getName(), null);
    }

}
?>