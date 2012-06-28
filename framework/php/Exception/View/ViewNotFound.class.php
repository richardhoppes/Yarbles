<?php

class Exception_View_ViewNotFound extends Exception_View {
	protected $strView;

	public function __construct($strView = null) {
		$strView ? $this->strView = $strView : null;
		parent::__construct('View Not Found');
	}

	public function getView() {
		return $this->strView;
	}
}