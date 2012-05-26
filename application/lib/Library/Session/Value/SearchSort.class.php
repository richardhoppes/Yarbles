<?
class Library_Session_Value_SearchSort extends Library_Session_Value {

    const SEARCH_RESULT_ORDER_RATING = "rating";
    const SEARCH_RESULT_ORDER_TITLE = "title";
    const SEARCH_RESULT_ORDER_YEAR = "year";
    const SEARCH_RESULT_ORDER_RELEVANCY = "relevancy";
    const SEARCH_RESULT_ORDER_AVAILABILITY_DATE = "availabilityDate";
    const SEARCH_RESULT_ORDER_EXPIRATION_DATE = "expirationDate";

    public function __construct() {
        $this->strKey = 'searchResultOrderField';
        $this->strDefaultValue = self::SEARCH_RESULT_ORDER_RELEVANCY;
    }
}