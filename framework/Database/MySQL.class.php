<?php
/**
 * MySQL database class
 * TODO: Adapters for different database types (mysql, sql server, etc...)
 * @throws Exception
 * @author Richard Hoppes <rhoppes@gmail.com>
 */
class Database_MySQL extends Database {

    private static $objDatabaseMySQL;

    const QUERY_TYPE_SELECT = 'queryTypeSelect';
    const QUERY_TYPE_DELETE = 'queryTypeDelete';
    const QUERY_TYPE_UPDATE = 'queryTypeUpdate';
    const QUERY_TYPE_INSERT = 'queryTypeInsert';
    const QUERY_TYPE_CREATE = 'queryTypeCreate';
    const QUERY_TYPE_DROP = 'queryTypeDrop';

    /**
     * Constructor
     */
    private function __construct() {
        $objConfig = Config::getHandle();

        $this->strDomain = $objConfig->DATABASE_SERVER;
        $this->strUsername = $objConfig->DATABASE_USERNAME;
        $this->strPassword = $objConfig->DATABASE_PASSWORD;
        $this->strDatabaseName = $objConfig->DATABASE_NAME;

        $this->dbLink = @mysql_connect($this->strDomain, $this->strUsername, $this->strPassword);
        if(!$this->dbLink)
            throw new Exception_Database_ConnectionFailed($this->strDomain);

        if(!@mysql_select_db($this->strDatabaseName, $this->dbLink))
            throw new Exception_Database_DatabaseSelectFailed($this->strDatabaseName);
    }

    /**
     * Make sure returned instance is a singleton
     * TODO: Address issue of only being able to create one database connection - what if we need a read-only instance?
     * @static
     * @return object
     */
    public static function getHandle() {
        if(!self::$objDatabaseMySQL) {
            self::$objDatabaseMySQL = new self();
        }
        return self::$objDatabaseMySQL;
    }

    /**
     * Execute a query
     * @throws Exception
     * @param string $strQuery
     * @param array $arrVariables
     * @param string $strQueryType
     * @return array|int
     */
    public function query($strQuery, $arrVariables = array(), $strQueryType = self::QUERY_TYPE_SELECT) {
        $strQuery = $this->prepareQuery($strQuery, $arrVariables);

        $mxdResult = null;
        switch($strQueryType) {
            // Select statement
            case self::QUERY_TYPE_SELECT:
                $arrResults = array();
                if($result = mysql_query($strQuery, $this->dbLink)) {
                    while($arrRow = mysql_fetch_assoc($result)) {
                        $arrResults[] = $arrRow;
                    }
                } else {
                    throw new Exception_Database_StatementFailed($strQuery, mysql_error($this->dbLink));
                }
                $mxdResult = $arrResults;
                break;

            // Insert statement
            case self::QUERY_TYPE_INSERT:
                $result = mysql_query($strQuery, $this->dbLink);
                if(!$result)
                    throw new Exception_Database_StatementFailed($strQuery, mysql_error($this->dbLink));
                $mxdResult = $this->getInsertId();
                break;

            // Update, delete, create and drop statements
            // TODO: Implement code specific to type of statement
            case self::QUERY_TYPE_UPDATE:
            case self::QUERY_TYPE_DELETE:
            case self::QUERY_TYPE_CREATE:
            case self::QUERY_TYPE_DROP:
                $result = mysql_query($strQuery, $this->dbLink);
                if(!$result)
                    throw new Exception_Database_StatementFailed($strQuery, mysql_error($this->dbLink));
                $mxdResult = true;
                break;

            // Unsupported query type
            default:
                throw new Exception_Database_UnsupportedQueryType($strQueryType);
                break;
        }

        return $mxdResult;
    }

    /**
     * Get last insert id
     * @return int
     */
    private function getInsertId() {
        return mysql_insert_id($this->dbLink);
    }

    /**
     * Prepare the query to run!
     * 1. Replace all val($key) with $arrVariables[$key]
     * 2. Escape value
     * @param $strQuery
     * @param $arrVariables
     * @return mixed
     */
    public function prepareQuery($strQuery, $arrVariables) {

        // Find all tokens
        preg_match_all('/val\([A-Za-z0-9\s-_]*\)/i', $strQuery, $arrTokens);
        if(isset($arrTokens[0]) && sizeof($arrTokens[0]) > 0) {

            // Loop all token matches
            foreach($arrTokens[0] as $intIndex => $strToken) {

                // Find actual token variable
                preg_match('/val\(([A-Za-z0-9\s-_]*)\)/i', $strToken, $arrTokenVar);
                if(isset($arrTokenVar[1])) {

                    // Perform token replacement
                    $strTokenVar = trim($arrTokenVar[1]);

                    if(is_string($arrVariables[$strTokenVar]) && $arrVariables[$strTokenVar] == "") {
                        $strQuery = str_replace($strToken, "'".$this->prepareValue($arrVariables[$strTokenVar])."'", $strQuery);

                    } elseif(is_string($arrVariables[$strTokenVar])) {
                        $strQuery = str_replace($strToken, "'".$this->prepareValue($arrVariables[$strTokenVar])."'", $strQuery);

                    } elseif (is_numeric($arrVariables[$strTokenVar])){
                        $strQuery = str_replace($strToken, $this->prepareValue($arrVariables[$strTokenVar]), $strQuery);

                    } elseif (is_null($arrVariables[$strTokenVar])) {
                        $strQuery = str_replace($strToken, "NULL", $strQuery);

                    }
                }
            }
        }
        return $strQuery;
    }

    /**
     * Make value safe before using it in a query
     * @param $strValue
     * @return string
     */
    public function prepareValue($strValue) {
        return mysql_real_escape_string($strValue, $this->dbLink);
    }

}