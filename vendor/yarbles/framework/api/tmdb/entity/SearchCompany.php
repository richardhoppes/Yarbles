<?
namespace yarbles\framework\api\tmdb\entity;

/**
 * Entity for results returned by company search
 * @author Richard Hoppes
 */
class SearchCompany {

	protected $intId = 0;
	protected $strName;
	protected $strLogoPath;

	public function setId($intId) {
		$this->intId = (int) $intId;
	}

	public function getId() {
		return $this->intId;
	}

	public function setName($strName) {
		$this->strName = $strName;
	}

	public function getName() {
		return $this->strName;
	}

	public function setLogoPath($strLogoPath) {
		$this->strLogoPath = (int) $strLogoPath;
	}

	public function getLogoPath() {
		return $this->strLogoPath;
	}

}