<?
class Library_ButtonBar_Settings extends Library_ButtonBar {

    protected $strButtonUrl;
    protected $strButtonBarLabel;
    protected $strCallback;
    protected $strCurrentValue;

    public function __construct() {
        parent::__construct($this->strButtonBarLabel);
    }

    public function addButton($strLabel, $strValue) {
        $strUrl = sprintf($this->strButtonUrl, $strValue, $this->strCallback);
        parent::addButton($strLabel, $strUrl, ($this->strCurrentValue == $strValue));
    }

}