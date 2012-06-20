<?php
class SearchTest extends UnitTestCase {

    function testSearchMovie_FoundResults() {
        $strTitle = "Terminator";

        $objService = new Service_Tmdb_Search();
        $objResult = $objService->searchMovie($strTitle);

        $this->assertTrue( $objResult->getTotalResults() > 0 );
        $this->assertTrue( sizeof($objResult->getResults()) > 0 );
        $this->assertEqual( $objResult->getPage(), 1 );
        $this->assertTrue( $objResult->getTotalPages() > 0 );
    }

    function testSearchMovie_NoResults() {
        $strTitle = "TEST_MOVIE_SEARCH_NO_RESULTS";

        $objService = new Service_Tmdb_Search();
        $objResult = $objService->searchMovie($strTitle);

        $this->assertEqual( $objResult->getTotalResults(), 0 );
        $this->assertEqual( sizeof($objResult->getResults()), 0 );
        $this->assertEqual( $objResult->getPage(), 0 );
        $this->assertEqual( $objResult->getTotalPages(), 0 );
    }

}
?>