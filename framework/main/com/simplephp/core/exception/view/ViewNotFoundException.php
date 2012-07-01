<?php
namespace com\simplephp\core\exception\view;

use com\simplephp\core\exception\view\BaseViewException;

class ViewNotFoundException extends BaseViewException {
	protected $strView;

	public function __construct($strView = null) {
		$strView ? $this->strView = $strView : null;
		parent::__construct('View Not Found');
	}

	public function getView() {
		return $this->strView;
	}
}