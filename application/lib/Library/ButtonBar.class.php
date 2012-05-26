<?php

class Library_ButtonBar {
    protected $strLabel;
    protected $arrButtons = array();

    public function __construct($strLabel = null) {
        $this->strLabel = $strLabel;
    }

    public function addButton($strLabel, $strUrl, $boolSelected, $mxdId = null, $strClass = null) {
        $this->arrButtons[] = array('label'=>$strLabel, 'url' => $strUrl, 'selected' => $boolSelected, 'id' => $mxdId, 'class' => $strClass);
    }

    public function getHtml() {
        $strHtml = "<div class=\"button-bar-container\"><div class=\"button-bar-container-inner\">";
        $strHtml .= $this->strLabel != null ? "<div class=\"button-bar-label\">{$this->strLabel}</div>" : "";

        foreach($this->arrButtons as $intIndex => $arrButton) {
            $strId = $arrButton['id'] ? "id=\"{$arrButton['id']}\"" : "";
            $strClass = $arrButton['class'] ? $arrButton['class'] : "";
            $strSelected = $arrButton['selected'] ? "button-bar-button-selected" : "button-bar-button";

            $strHtml .= "<a {$strId} class=\"{$strSelected} {$strClass}\" href=\"{$arrButton['url']}\">{$arrButton['label']}</a>";
        }

        $strHtml .= "<div style=\"clear: both;\"></div></div></div>";

        return $strHtml;
    }
}