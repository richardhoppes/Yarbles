<?php
class SearchTest extends UnitTestCase {

    function testSearchMovie_FoundResults() {
        $strQuery = "Terminator";

        $objService = new Api_Tmdb_Search();
        $objResult = $objService->searchMovie($strQuery);

        $this->assertTrue( $objResult->getTotalResults() > 0 );
        $this->assertTrue( sizeof($objResult->getResults()) > 0 );
        $this->assertEqual( $objResult->getPage(), 1 );
        $this->assertTrue( $objResult->getTotalPages() > 0 );
    }

    function testSearchMovie_NoResults() {
        $strQuery = "TEST_MOVIE_SEARCH_NO_RESULTS";

        $objService = new Api_Tmdb_Search();
        $objResult = $objService->searchMovie($strQuery);

        $this->assertEqual( $objResult->getTotalResults(), 0 );
        $this->assertEqual( sizeof($objResult->getResults()), 0 );
        $this->assertEqual( $objResult->getPage(), 0 );
        $this->assertEqual( $objResult->getTotalPages(), 0 );
    }

    function testSearchPerson_FoundResults() {
        $strQuery = "Sasha";

        $objService = new Api_Tmdb_Search();
        $objResult = $objService->searchPerson($strQuery);

        $this->assertTrue( $objResult->getTotalResults() > 0 );
        $this->assertTrue( sizeof($objResult->getResults()) > 0 );
        $this->assertEqual( $objResult->getPage(), 1 );
        $this->assertTrue( $objResult->getTotalPages() > 0 );
    }

    function testSearchPerson_NoResults() {
        $strQuery = "TEST_PERSON_SEARCH_NO_RESULTS";

        $objService = new Api_Tmdb_Search();
        $objResult = $objService->searchPerson($strQuery);

        $this->assertEqual( $objResult->getTotalResults(), 0 );
        $this->assertEqual( sizeof($objResult->getResults()), 0 );
        $this->assertEqual( $objResult->getPage(), 0 );
        $this->assertEqual( $objResult->getTotalPages(), 0 );
    }

    function testSearchCompany_FoundResults() {
        $strQuery = "Sony";

        $objService = new Api_Tmdb_Search();
        $objResult = $objService->searchCompany($strQuery);

        $this->assertTrue( $objResult->getTotalResults() > 0 );
        $this->assertTrue( sizeof($objResult->getResults()) > 0 );
        $this->assertEqual( $objResult->getPage(), 1 );
        $this->assertTrue( $objResult->getTotalPages() > 0 );
    }

    function testSearchCompany_NoResults() {
        $strQuery = "TEST_COMPANY_SEARCH_NO_RESULTS";

        $objService = new Api_Tmdb_Search();
        $objResult = $objService->searchCompany($strQuery);

        $this->assertEqual( $objResult->getTotalResults(), 0 );
        $this->assertEqual( sizeof($objResult->getResults()), 0 );
        $this->assertEqual( $objResult->getPage(), 0 );
        $this->assertEqual( $objResult->getTotalPages(), 0 );
    }
}
?>