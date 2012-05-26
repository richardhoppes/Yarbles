<?
class Library_ButtonBar_Settings_DisplayFormat extends Library_ButtonBar_Settings {

    public function __construct() {
        $this->strButtonUrl = "/settings/toggledatagriddisplayformat/?format=%s&callback=%s";
        $this->strButtonBarLabel = "Display:";
        $this->strCallback = urlencode($_SERVER['REQUEST_URI']);

        $objDisplayFormat = new Library_Session_Value_DisplayFormat();
        $this->strCurrentValue = $objDisplayFormat->getValue();

        $this->addButton('Detail', Library_Session_Value_DisplayFormat::DISPLAY_FORMAT_DETAIL);
        $this->addButton('List', Library_Session_Value_DisplayFormat::DISPLAY_FORMAT_GRID);

        parent::__construct();
    }

}