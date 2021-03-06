<?
namespace yarbles\framework\api\tmdb\entity;

use yarbles\framework\api\tmdb\entity\SearchResponseInterface;

/**
 * Search response class
 * @author Richard Hoppes
 */
class SearchResponse implements SearchResponseInterface {

    protected $intPage = 0;
    protected $intTotalPages = 0;
    protected $intTotalResults = 0;
    protected $arrResults = array();

    public function setPage($intPage) {
        $this->intPage = (int) $intPage;
    }

    public function getPage() {
        return $this->intPage;
    }

    public function setTotalPages($intTotalPages) {
        $this->intTotalPages = (int) $intTotalPages;
    }

    public function getTotalPages() {
        return $this->intTotalPages;
    }

    public function setTotalResults($intTotalResults) {
        $this->intTotalResults = (int) $intTotalResults;
    }

    public function getTotalResults() {
        return $this->intTotalResults;
    }

    public function setResults($arrResults) {
        $this->arrResults = $arrResults;
    }

    public function getResults() {
        return $this->arrResults;
    }
}