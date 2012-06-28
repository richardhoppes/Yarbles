<?php

class Autoload {

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

    }
}