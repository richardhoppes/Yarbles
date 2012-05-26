<?php
/**
 * Base controller class
 * @throws Exception
 * @author Richard Hoppes <rhoppes@gmail.com>
 */
class Controller {
    public function __construct() {
        // Do something
    }

    /**
     * Attempt to load view by replacing _ with / in view name
     * @throws Exception
     * @param string $strView
     * @param array $arrParams
     * @return void
     */
    public function loadView($strView, $arrParams = array()) {

        $objConfig = Config::getHandle();

        // Make sure session is loaded before displaying view
        $objSession = Session::getHandle();

        // Look for application view first
        if(file_exists($objConfig->APP_VIEW_PATH . '/' . str_replace('_', '/', $strView ) . ".php"))
            include_once($objConfig->APP_VIEW_PATH . '/' . str_replace('_', '/', $strView ) . ".php");

        // Fall back to framework view
        elseif(file_exists($objConfig->FW_VIEW_PATH . '/' . str_replace('_', '/', $strView ) . ".php"))
            include_once($objConfig->FW_VIEW_PATH . '/' . str_replace('_', '/', $strView ) . ".php");

        // If no view exists, throw exception
        else
            throw new Exception_View_ViewNotFound($strView);
    }

    /**
     * Redirect to url
     * @param $strUrl
     * @return void
     */
    public function redirect($strUrl) {
        header("Location {$strUrl}");
    }
}