<?php
/**
 * Error controller
 * To implement custom error handling, simply override this class in the application/lib/Controller directory
 * @author Richard Hoppes <rhoppes@gmail.com>
 */
class Controller_Error extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function pageNotFound($e) {
        header("HTTP/1.0 404 Not Found");
        $arrParams = array();
        $arrParams['title'] = '404 Not Found';
        $arrParams['message'] = 'The page you requested could not be found.';
        $arrParams['exception'] = $e;
        $this->loadView( 'Error_Default', $arrParams );
    }

    public function notAuthorized($e) {
        header("HTTP/1.0 404 Forbidden");
        $arrParams = array();
        $arrParams['title'] = '401 Not Authorized';
        $arrParams['message'] = 'You are not authorized to view this page.';
        $arrParams['exception'] = $e;
        $this->loadView( 'Error_Default', $arrParams );
    }

    public function internalServerError($e) {
        header("HTTP/1.0 500 Internal Server Error");
        $arrParams = array();
        $arrParams['title'] = '500 Internal Server Error';
        $arrParams['message'] = 'There was a problem displaying the page you requested.';
        $arrParams['exception'] = $e;
        $this->loadView( 'Error_Default', $arrParams );
    }

    public function main($e) {
        $arrParams = array();
        $arrParams['title'] = 'OOPS!  Something is broken';
        $arrParams['message'] = 'The page you requested could not be opened.';
        $arrParams['exception'] = $e;
        $this->loadView( 'Error_Default', $arrParams );
    }
}