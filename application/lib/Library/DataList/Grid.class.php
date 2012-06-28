<?php
class Library_DataList_Grid extends DataList {

	protected $boolShowHeaderRow = true;
	protected $arrColumns = array();
	protected $strNoResultsMessage;

	public function __construct(
		$arrData,
		$intRecordsPerPage,
		$intPageNumber,
		$strURL = null,
		$boolShowHeaderRow = true,
		$boolShowPagingControls = true,
		$strNoResultsMessage = "No results.") {

		$this->boolShowHeaderRow = $boolShowHeaderRow;
		$this->strNoResultsMessage = $strNoResultsMessage;

		parent::__construct(
			$arrData,
			$intRecordsPerPage,
			$intPageNumber,
			$strURL,
			$boolShowPagingControls);
	}

	public function addColumn($strField, $strLabel) {
		$arrColumn = array();
		$arrColumn['strField'] = $strField;
		$arrColumn['strLabel'] = $strLabel;
		$this->arrColumns[] = $arrColumn;
	}

	protected function buildResultHTML() {

		$strHTML = "";
		$strRowClass = "";

		foreach($this->arrData as $intIndex => $arrRow) {
			// Header row
			if($intIndex == 0 && $this->boolShowHeaderRow) {
				$strHTML .= "<tr>\n";
				foreach($this->arrColumns as $intColumnIndex => $arrColumnDefinition) {
				$strHTML .= "<td class=\"grid_header grid_header_{$intColumnIndex}\">{$arrColumnDefinition['strLabel']}</td>\n";
				}
				$strHTML .= "</tr>\n";
			}
			// Data row
			if($intIndex >= $this->intStartRecord && $intIndex <= $this->intEndRecord) {
				if ($strRowClass == "grid-data-alt") {
					$strRowClass = "grid-data";
				} else {
					$strRowClass = "grid-data-alt";
				}

				$strHTML .= "<tr>\n";
					foreach($this->arrColumns as $intColumnIndex => $arrColumnDefinition) {
					$strHTML .= "<td class=\"{$strRowClass} grid-data-{$intColumnIndex}\">{$this->arrData[$intIndex][$arrColumnDefinition['strField']]}</td>\n";
					}
					$strHTML .= "</tr>\n";
			}
		}

		$strHTML = "
			<table cellspacing=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"grid-table\">
			{$strHTML}
			</table>
			";

		return $strHTML;
	}

}