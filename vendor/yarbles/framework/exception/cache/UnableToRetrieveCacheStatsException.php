<?php
namespace yarbles\framework\exception\cache;

use yarbles\framework\exception\cache\BaseCacheException;

class UnableToRetrieveCacheStatsException extends BaseCacheException {

	protected $strStatusMessage;

	public function __construct($strStatusMessage) {
		$this->strStatusMessage = $strStatusMessage;
		parent::__construct('Unable to retrieve stats');
	}

	public function getErrorMessage() {
		return $this->strStatusMessage;
	}
}