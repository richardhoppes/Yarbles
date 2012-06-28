<?php

abstract class Api_Tmdb {

	const BASE_API_URL = 'http://api.themoviedb.org/3/';

	protected $strApiKey;

	protected $objHttpClient;

	public function __construct() {
		$objConfig = Config::getHandle();
		$this->strApiKey = $objConfig->TMDB_API_KEY;
		$this->objHttpClient = new Client_Http();
	}

}
