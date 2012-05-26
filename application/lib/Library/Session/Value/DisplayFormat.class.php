<?
class Library_Session_Value_DisplayFormat extends Library_Session_Value {

    const DISPLAY_FORMAT_DETAIL = "detail";
    const DISPLAY_FORMAT_GRID = "grid";

    public function __construct() {
        $this->strKey = 'dataGridFormat';
        $this->strDefaultValue = self::DISPLAY_FORMAT_DETAIL;
    }
}