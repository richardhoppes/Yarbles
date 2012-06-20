<?php

class Service_Tmdb_Entity_SearchMovie {

    protected $boolAdult = false;
    protected $strBackdropPath;
    protected $intId = 0;
    protected $strOriginalTitle;
    protected $strTitle;
    protected $dateReleaseDate;
    protected $strPosterPath;
    protected $dblPopularity = 0.0;
    protected $intVoteAverage = 0;
    protected $intVoteCount = 0;

    public function setAdult($boolAdult) {
        $this->boolAdult = $boolAdult ? 1 : 0;
    }

    public function getAdult() {
        return $this->boolAdult;
    }

    public function setReleaseDate($dateReleaseDate) {
        $this->dateReleaseDate = $dateReleaseDate ? strtotime($dateReleaseDate) : 0;
    }

    public function getReleaseDate() {
        return $this->dateReleaseDate;
    }

    public function setPopularity($dblPopularity) {
        $this->dblPopularity = (double) $dblPopularity;
    }

    public function getPopularity() {
        return $this->dblPopularity;
    }

    public function setId($intId) {
        $this->intId = (int) $intId;
    }

    public function getId() {
        return $this->intId;
    }

    public function setVoteAverage($intVoteAverage) {
        $this->intVoteAverage = (int) $intVoteAverage;
    }

    public function getVoteAverage() {
        return $this->intVoteAverage;
    }

    public function setVoteCount($intVoteCount) {
        $this->intVoteCount = (int) $intVoteCount;
    }

    public function getVoteCount() {
        return $this->intVoteCount;
    }

    public function setBackdropPath($strBackdropPath) {
        $this->strBackdropPath = $strBackdropPath;
    }

    public function getBackdropPath() {
        return $this->strBackdropPath;
    }

    public function setOriginalTitle($strOriginalTitle) {
        $this->strOriginalTitle = $strOriginalTitle;
    }

    public function getOriginalTitle() {
        return $this->strOriginalTitle;
    }

    public function setPosterPath($strPosterPath) {
        $this->strPosterPath = $strPosterPath;
    }

    public function getPosterPath() {
        return $this->strPosterPath;
    }

    public function setTitle($strTitle) {
        $this->strTitle = $strTitle;
    }

    public function getTitle() {
        return $this->strTitle;
    }
}