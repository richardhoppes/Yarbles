<?php

class Service_Tmdb_Entity_Movie {

    protected $intPopularity;
    protected $boolTranslated;
    protected $strLanguage;
    protected $strOriginalName;
    protected $strName;
    protected $strAlternativeName;
    protected $strMovieType;
    protected $strId;
    protected $strImdbId;
    protected $strUrl;
    protected $strOverview;
    protected $intVotes;
    protected $strCertification;
    protected $dateReleaseDate;
    protected $arrImages;
    protected $strVersion;
    protected $dateLastModifiedAt;
    protected $intRating;

    public function setAlternativeName($alternativeName) {
        $this->strAlternativeName = (string) $alternativeName;
    }

    public function getAlternativeName() {
        return $this->strAlternativeName;
    }

    public function setCertification($certification) {
        $this->strCertification = (string) $certification;
    }

    public function getCertification() {
        return $this->strCertification;
    }

    public function setId($id) {
        $this->strId = (string) $id;
    }

    public function getId() {
        return $this->strId;
    }

    public function setImdbId($imdbId) {
        $this->strImdbId = (string) $imdbId;
    }

    public function getImdbId() {
        return $this->strImdbId;
    }

    public function setLanguage($language) {
        $this->strLanguage = (string) $language;
    }

    public function getLanguage() {
        return $this->strLanguage;
    }

    public function setLastModifiedAt($lastModifiedAt) {
        $this->dateLastModifiedAt = $lastModifiedAt ? strtotime($lastModifiedAt) : 0;
    }

    public function getLastModifiedAt() {
        return $this->dateLastModifiedAt;
    }

    public function setMovieType($movieType) {
        $this->strMovieType = (string) $movieType;
    }

    public function getMovieType() {
        return $this->strMovieType;
    }

    public function setName($name) {
        $this->strName = (string) $name;
    }

    public function getName() {
        return $this->strName;
    }

    public function setOriginalName($originalName) {
        $this->strOriginalName = (string) $originalName;
    }

    public function getOriginalName() {
        return $this->strOriginalName;
    }

    public function setOverview($overview) {
        $this->strOverview = (string) $overview;
    }

    public function getOverview() {
        return $this->strOverview;
    }

    public function setPopularity($popularity) {
        $this->intPopularity = (int) $popularity;
    }

    public function getPopularity() {
        return $this->intPopularity;
    }

    public function setReleaseDate($releaseDate) {
        $this->dateReleaseDate = $releaseDate  ? strtotime($releaseDate) : 0;;
    }

    public function getReleaseDate() {
        return $this->dateReleaseDate;
    }

    public function setTranslated($translated) {
        $this->boolTranslated = $translated ? 1 : 0;
    }

    public function getTranslated() {
        return $this->boolTranslated;
    }

    public function setUrl($url) {
        $this->strUrl = (string) $url;
    }

    public function getUrl() {
        return $this->strUrl;
    }

    public function setVersion($version) {
        $this->strVersion = (string) $version;
    }

    public function getVersion() {
        return $this->strVersion;
    }

    public function setVotes($votes) {
        $this->intVotes = (int) $votes;
    }

    public function getVotes() {
        return $this->intVotes;
    }

    public function setImages($images) {
        $this->arrImages = $images;
    }

    public function getImages() {
        return $this->arrImages;
    }

    public function setRating($rating) {
        $this->intRating = (int) $rating;
    }

    public function getRating() {
        return $this->intRating;
    }
}