<?php
/**
 * Cache not connected
 * @author Richard Hoppes <rhoppes@gmail.com>
 */
class Exception_Cache_NotConnected extends Exception_Controller {
    protected $strInfo;

    public function __construct($strInfo = null) {
        $strInfo ? $this->strInfo = $strInfo : null;
        parent::__construct('Not connected');
    }

    public function getStrInfo() {
        return $this->strInfo;
    }

    public function setStrInfo($strInfo) {
        $this->strInfo = $strInfo;
    }
}