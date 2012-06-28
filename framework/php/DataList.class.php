<?php

abstract class DataList {

	protected $arrData = array();
	protected $intRecordCount = 0;
	protected $intRecordsPerPage= 0;
	protected $intPageNumber = 1;
	protected $intNumberOfPages = 1;
	protected $strHTML;
	protected $strURL;
	protected $boolShowPagingControls;
	protected $arrMessages = array();

	protected $intStartRecord;
	protected $intEndRecord;
	protected $intDisplayEndRecord;

	public function __construct(
		$arrData,
		$intRecordsPerPage,
		$intPageNumber,
		$strURL = null,
		$boolShowPagingControls = true) {

		$this->intRecordCount               = sizeof($arrData);
		$this->arrData                      = $arrData;
		$this->intRecordsPerPage            = $intRecordsPerPage;
		$this->intPageNumber                = $intPageNumber;
		$this->boolShowPagingControls       = $boolShowPagingControls;
		$this->strURL                       = $strURL ? $strURL : $_SERVER['REQUEST_URI'];

		// Calculate start/end record numbers
		if(!$this->doPaging()) {
			$this->intStartRecord = 0;
			$this->intEndRecord = $this->intRecordCount - 1;
		} else {
			if($this->intPageNumber == 1) {
				$this->intStartRecord = 0;
			} else {
				$this->intStartRecord = ($this->intPageNumber - 1) * $this->intRecordsPerPage;
			}
			$this->intEndRecord = $this->intStartRecord + $this->intRecordsPerPage - 1;
		}

		// Calculate last record number to display
		if(($this->intEndRecord + 1) > $this->intRecordCount)
			$this->intDisplayEndRecord = $this->intRecordCount;
		else
			$this->intDisplayEndRecord = $this->intEndRecord + 1;

		// Calculate page count
		$this->intNumberOfPages = ((int) ($this->intRecordCount / $this->intRecordsPerPage));
		if (($this->intRecordCount % $this->intRecordsPerPage) > 0) {
			$this->intNumberOfPages++;
		}
	}

	public function addMessage($strMessage) {
		$this->arrMessages[] = $strMessage;
	}

	public function getRecordCount() {
		return $this->intRecordCount;
	}

	public function getNumberOfPages() {
		return $this->intNumberOfPages;
	}

	public function doPaging() {
		$boolPaging = false;
		if($this->boolShowPagingControls && $this->intRecordsPerPage > 0)
			$boolPaging = true;
		return $boolPaging;
	}

	public function buildHTML() {
		if($this->intRecordCount == 0) {
			$this->strHTML .= $this->buildNoResultsHTML();
		} else {
			$this->strHTML .= $this->buildResultHTML();
			$this->strHTML .= $this->buildFooterHTML();
		}
	}

	protected function buildNoResultsHTML() {
		$strHTML = "
		<div class=\"list-empty\">{$this->strNoResultsMessage}</div>
		";
		return $strHTML;
	}

	protected function buildFooterHTML() {
		$strHTML = "";
		if($this->doPaging() || sizeof($this->arrMessages) > 0) {
			$strHTML .= "<div class=\"list-footer\" style=\"width: 100%;\">";
			$strHTML .= $this->doPaging() ? $this->buildPageControl() : "";
			$strHTML .= (sizeof($this->arrMessages) > 0) ? $this->buildMessages() : "";
			$strHTML .= "<div class=\"clear\"></div>";
			$strHTML .= "</div>";
		}
		return $strHTML;
	}

	abstract protected function buildResultHTML();

	private function buildPageControl() {
		$strPageUrl = preg_replace('/searchPage=[0-9]*/i', 'searchPage=@@page@@', $this->strURL);

		$intShowRightPages 		= 5;
		$intShowLeftPages 		= 5;

		// Get first/last values
		$intFirstPage 		= ($this->intPageNumber - $intShowLeftPages);
		$intLastPage 		= ($this->intPageNumber + $intShowRightPages);

		// Find out if first/last values went too far
		$intFirstTooFar 	= ($intFirstPage < 1) ? (($intFirstPage - 1) * -1) : 0;
		$intLastTooFar 		= ($intLastPage > $this->intNumberOfPages) ? ($intLastPage - $this->intNumberOfPages) : 0;

		// Adjust first/last values accordingly
		if($intFirstTooFar && !$intLastTooFar) {
			$intFirstPage = 1;

			if(($intLastPage + $intFirstTooFar) > $this->intNumberOfPages)
				$intLastPage = $this->intNumberOfPages;
			else
				$intLastPage += $intFirstTooFar;
		} elseif(!$intFirstTooFar && $intLastTooFar) {
			$intLastPage = $this->intNumberOfPages;

			if($intFirstPage - $intLastTooFar < 1)
				$intFirstPage = 1;
			else
				$intFirstPage -= $intLastTooFar;
		} elseif($intFirstTooFar && $intLastTooFar) {
			$intFirstPage = 1;
			$intLastPage = $this->intNumberOfPages;
		}

		$strHTML = "
		<div class=\"paging-control\">
		<div class=\"paging-control-text\">
		";

		// First/Prev Buttons
		if($this->intPageNumber != 1) {
			$strHTML .= "
				<a href=\"".str_replace('@@page@@',1,$strPageUrl)."\" class=\"other-page\">&laquo; First</a>
			";

			$strHTML .= "
				<a href=\"".str_replace('@@page@@',($this->intPageNumber - 1),$strPageUrl)."\" class=\"other-page\">&lsaquo; Previous</a>
			";
		} else {
			$strHTML .= "
				<div class=\"other-page-disabled\">&laquo; First</div>
			";

			$strHTML .= "
				<div class=\"other-page-disabled\">&lsaquo; Previous</div>
			";
		}

		// Create paging output
		for($intX = $intFirstPage; $intX <= $intLastPage; $intX++) {
			if($intX == $this->intPageNumber) {
				$strHTML .= "
				<a href=\"".str_replace('@@page@@',$intX,$strPageUrl)."\" class=\"current-page\">{$intX}</a>
				";
			} else {
				$strHTML .= "
				<a href=\"".str_replace('@@page@@',$intX,$strPageUrl)."\" class=\"other-page\">{$intX}</a>
				";
			}
		}

		// Next/Last Buttons
		if($this->intPageNumber != $this->intNumberOfPages) {
			$strHTML .= "
				<a href=\"".str_replace('@@page@@',($this->intPageNumber + 1),$strPageUrl)."\" class=\"other-page\">Next &rsaquo;</a>
			";

			$strHTML .= "
				<a href=\"".str_replace('@@page@@',$this->intNumberOfPages,$strPageUrl)."\" class=\"other-page\">Last &raquo;</a>
			";
		} else {
			$strHTML .= "
				<div class=\"other-page-disabled\">Next &rsaquo;</div>
			";

			$strHTML .= "
				<div class=\"other-page-disabled\">Last &raquo;</div>
			";
		}

		$strResultDisplay = ($this->intRecordCount == 1) ? "result" : "results";
		$strPageDisplay = ($this->intNumberOfPages == 1) ? "page" : "pages";

		$strHTML .= "
				<div class=\"paging-info\">".number_format($this->intRecordCount,0,".",",") ." {$strResultDisplay} found (".number_format($this->intNumberOfPages,0,".",",") ." {$strPageDisplay})</div>

			<div class=\"clear\"></div>\n
		</div>
		</div>
		";

		return $strHTML;
	}

	protected function buildMessages() {
		$strHTML = "";
		if(sizeof($this->arrMessages) > 0) {
			$strHTML .= "<div class=\"messages\">";
			$intMessageIndex = 0;
			foreach($this->arrMessages as $strMessage) {
				$strHTML .= ($intMessageIndex > 0) ? "<br />" : "";
				$strHTML .= $strMessage;
			}
			$strHTML .= "</div>";
		}
		return $strHTML;
	}

	public function getHTML() {
		$this->buildHTML();
		return $this->strHTML;
	}
}