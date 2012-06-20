<?php
/**
 * Auto load class
 * @throws Exception
 * @author Richard Hoppes <rhoppes@gmail.com>
 */
class Autoload {
    /**
     * Load class
     * @throws Exception
     * @return void
     */
    public static function load($strClass) {

        $objConfig = Config::getHandle();

        // Application classes
        if(file_exists($objConfig->APP_PATH . "/" . str_replace('_', '/', $strClass ) . ".class.php")) {
            include_once( $objConfig->APP_PATH  . "/" . str_replace('_', '/', $strClass ) . ".class.php");
        }

        // Framework library classes
        elseif(file_exists($objConfig->FW_PATH . "/" . str_replace('_', '/', $strClass ) . ".class.php")) {
            include_once( $objConfig->FW_PATH . "/" . str_replace('_', '/', $strClass ) . ".class.php");
        }

        // Framework test classes
        /*
        elseif( file_exists( $objConfig->FW_TEST_PATH . "/" . str_replace('_', '/', $strClass) . ".class.php") ) {
            require_once( $objConfig->EXT_PATH . '/simpletest/autorun.php' );
            include_once( $objConfig->FW_TEST_PATH . "/" . str_replace('_', '/', $strClass ) . ".class.php");
        }
        */

    }
}