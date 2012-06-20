<?php

class Command
{
    protected $command = array();

    private function getProperty($strName) {

        $strProperty = $strName;
        if(substr($strProperty, 0, 3) == "get") {
            $strProperty = substr($strProperty, 3, strlen($strProperty));
            $strProperty = lcfirst($strProperty);
        }

        return $this->command[$strProperty];
    }

    public function __call($strName, $arrArgs = array()) {
        return $this->getProperty($strName);
    }

}