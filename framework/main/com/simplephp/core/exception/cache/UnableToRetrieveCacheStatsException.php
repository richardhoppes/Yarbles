<?php
namespace com\simplephp\core\exception\cache;

use com\simplephp\core\exception\cache\BaseCacheException;

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