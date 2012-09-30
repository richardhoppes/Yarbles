<?
namespace yarbles\framework\api\tmdb\entity;

interface SearchResponseInterface {

	public function setPage($intPage);

	public function getPage();

	public function setTotalPages($intTotalPages);

	public function getTotalPages();

	public function setTotalResults($intTotalResults);

	public function getTotalResults();

	public function setResults($arrResults);

	public function getResults();

}