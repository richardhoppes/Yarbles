<?php

class Service_Tmdb_Entity_SearchPerson {

    protected $boolAdult = false;
    protected $intId = 0;
    protected $strName;
    protected $strProfilePath;

    public function setAdult($boolAdult) {
        $this->boolAdult = $boolAdult ? 1 : 0;
    }

    public function getAdult() {
        return $this->boolAdult;
    }

    public function setId($intId) {
        $this->intId = (int) $intId;
    }

    public function getId() {
        return $this->intId;
    }

    public function setName($strName) {
        $this->strName = $strName;
    }

    public function getName() {
        return $this->strName;
    }

    public function setProfilePath($strProfilePath) {
        $this->strProfilePath = (int) $strProfilePath;
    }

    public function getProfilePath() {
        return $this->strProfilePath;
    }

}