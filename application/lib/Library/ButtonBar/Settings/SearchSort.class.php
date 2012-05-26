<?
class Library_ButtonBar_Settings_SearchSort extends Library_ButtonBar_Settings {

    public function __construct() {
        $this->strButtonUrl = "/settings/togglesearchresultorder/?field=%s&callback=%s";
        $this->strButtonBarLabel = "Sort By:";
        $this->strCallback = urlencode($_SERVER['REQUEST_URI']);

        $objSearchSort = new Library_Session_Value_SearchSort();
        $this->strCurrentValue = $objSearchSort->getValue();

        $this->addButton('Title', Library_Session_Value_SearchSort::SEARCH_RESULT_ORDER_TITLE);
        $this->addButton('Rating', Library_Session_Value_SearchSort::SEARCH_RESULT_ORDER_RATING);
        $this->addButton('Year', Library_Session_Value_SearchSort::SEARCH_RESULT_ORDER_YEAR);
        $this->addButton('Relevancy', Library_Session_Value_SearchSort::SEARCH_RESULT_ORDER_RELEVANCY);
        $this->addButton('Newest', Library_Session_Value_SearchSort::SEARCH_RESULT_ORDER_AVAILABILITY_DATE);
        $this->addButton('Expiring Soon', Library_Session_Value_SearchSort::SEARCH_RESULT_ORDER_EXPIRATION_DATE);

        parent::__construct();
    }

}