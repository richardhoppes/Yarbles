<?php
namespace yarbles\framework\api\tmdb;

use yarbles\framework\service\RestService;
use yarbles\framework\common\YarblesLocator;

/**
 * Base Tmdb API class
 * @author Richard Hoppes
 */
abstract class Tmdb {

	const BASE_API_URL = 'http://api.themoviedb.org/3/';
	const API_HOST = 'api.themovedb.org';

	protected $strApiKey;

	protected $objRestService;

	protected $objConfig;

	public function __construct() {
		$this->objConfig= YarblesLocator::getConfig();
		$this->strApiKey = $this->objConfig->getProperty('tmdb_api_key');

		$this->objRestService = YarblesLocator::getRestService(self::API_HOST);
	}

}